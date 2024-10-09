<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OTPRequest;
use App\Http\Requests\Auth\OTPVerificationRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Jobs\SendOTPMailJob;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller {
    /**
     * Send OTP code to the user's email.
     *
     * @param OTPRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function SendOtpToEmail(OTPRequest $request): JsonResponse {
        try {
            $email = $request->input('email');
            $otp   = rand(1000, 9999);
            $user  = User::where('email', $email)->first();

            if ($user) {
                //! Dispatch OTP Email Job
                SendOTPMailJob::dispatch($email, $otp);
                //! OTP Email Address
                // Mail::to($email)->send(new OTPMail($otp));
                //! Update OTP in password_resets table
                PasswordReset::updateOrCreate(
                    [
                        'email' => $email,
                    ],
                    [
                        'otp'        => $otp,
                        'created_at' => Carbon::now(),
                    ]
                );
                return Helper::jsonResponse(true, 'OTP Code Sent Successfully', 200);
            } else {
                return Helper::jsonResponse(false, 'Invalid Email Address', 401);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to send otp', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Verify the provided OTP code.
     *
     * @param OTPVerificationRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function VerifyOTP(OTPVerificationRequest $request): JsonResponse {
        try {
            //* Retrieve the email from either the header or the body
            $email = $request->header('email') ?: $request->input('email');
            $otp   = $request->input('otp');

            //? Validate the presence of email and OTP
            if (!$email || !$otp) {
                return Helper::jsonResponse(false, 'Email and OTP are required', 400);
            }

            $passwordReset = PasswordReset::where('email', $email)
                ->where('otp', $otp)
                ->where('created_at', '>=', Carbon::now()->subMinutes(15))
                ->first();

            if ($passwordReset) {
                //! Retrieve the user based on the email
                $user = User::where('email', $email)->first();

                if ($user) {
                    $user->update([
                        'otp_verified_at' => Carbon::now(),
                    ]);

                    //! Delete the password reset entry
                    $passwordReset->delete();

                    return Helper::jsonResponse(true, 'OTP Verified Successfully', 200);
                } else {
                    return Helper::jsonResponse(false, 'User not found', 404);
                }
            } else {
                return Helper::jsonResponse(false, 'Invalid OTP Code', 401);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to verify otp', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Reset the user's password.
     *
     * @param PasswordResetRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function ResetPassword(PasswordResetRequest $request): JsonResponse {
        try {
            //* Retrieve the email from either the header or the body
            $email = $request->header('email') ?: $request->input('email');

            //! Validate the presence of email
            if (!$email) {
                return Helper::jsonResponse(false, 'Email address is required', 400);
            }

            $user = User::where('email', $email)->first();
            if ($user) {
                if (is_null($user->otp_verified_at)) {
                    return Helper::jsonResponse(false, 'OTP not verified', 403);
                }

                $password = Hash::make($request->input('password'));
                $user->update([
                    'password'        => $password,
                    'otp_verified_at' => null,
                ]);

                return Helper::jsonResponse(true, 'Password Reset Successfully', 200);
            } else {
                return Helper::jsonResponse(false, 'Invalid Email Address', 401);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Failed to reset password', 500, ['error' => $e->getMessage()]);
        }
    }
}
