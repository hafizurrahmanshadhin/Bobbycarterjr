<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts & SweetAlert2 --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e0e0e0);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
            box-sizing: border-box;
        }

        h2 {
            color: #c0392b;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: scale(1.03);
        }

        .icon-warning {
            font-size: 48px;
            color: #e67e22;
            margin-bottom: 10px;
        }

        @media (max-height: 500px),
        (max-width: 400px) {

            html,
            body {
                overflow: auto;
                padding: 20px;
                align-items: flex-start;
            }

            .container {
                margin-top: 40px;
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            .btn-danger {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon-warning">⚠️</div>

        <h2>Are you sure you want to delete your account?</h2>
        <p>This action is <strong>permanent</strong> and <strong>cannot be undone</strong>. All your data will be lost.
        </p>

        <form id="delete-form" method="POST" action="{{ route('user.delete') }}">
            @csrf
            @method('DELETE')

            <button type="button" class="btn-danger" id="delete-btn">
                🗑️ Delete My Account
            </button>
        </form>
    </div>

    <script>
        // SweetAlert confirmation before form submission
        document.getElementById('delete-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you absolutely sure?',
                text: "This action is permanent and cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        });

        // Flash messages (success / error)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#e74c3c'
            });
        @endif
    </script>
</body>

</html>
