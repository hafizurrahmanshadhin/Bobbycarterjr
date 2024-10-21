<?php

namespace App\Http\Controllers\web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TaskAnswersController extends Controller
{
    public function index(Request $request): JsonResponse | View {

        if ($request->ajax()) {
            $data = Answer::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    $fillname = $data->user->firstName . ' ' . $data->user->lastName;
                    return $fillname;
                })
                ->addColumn('course_name', function ($data) {
                    return $data->module->course->name ?? '-';
                })
                ->addColumn('module_name', function ($data) {
                    return $data->module->title ?? '-';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="#" type="button" onclick="showDetails(' . $data->id . ')" class="btn btn-info fs-14 text-white delete-icn" data-bs-target="#viewModal"
                                                data-bs-toggle="modal" title="View">
                                    <i class="fe fe-eye"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['user_name', 'course_name', 'module_name', 'action'])
                ->make();
        }

        return view('backend.layouts.task_answer.index');
    }

    /**
     * Display the specified Task answer.
     *
     * @param int $id
     * @return JsonResponse
    */

    public function single(int $id): JsonResponse {
        try {
            $data = Answer::with(['user:id,firstName,lastName', 'module:id,course_id,title', 'module.course:id,name'])->findOrFail($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
