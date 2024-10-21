@extends('backend.app')

@section('title', 'Task Answers')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Task Answers</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Task Answers</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">User Name</th>
                                    <th class="wd-15p border-bottom-0">Module Name</th>
                                    <th class="wd-15p border-bottom-0">Course Name</th>
                                    <th class="wd-15p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- dynamic data --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">
                        <i class="bi bi-eye"></i> View Course Module Answer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 550px; overflow: auto; width: 100%;">
                    <div class="form-group">
                        <label for="userName" class="form-label text-muted">User Name:</label>
                        <input type="text" id="userName" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="courseName" class="form-label text-muted">Course Name:</label>
                        <input type="text" id="courseName" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="moduleTitle" class="form-label text-muted">Module Title:</label>
                        <input type="text" id="moduleTitle" class="form-control" readonly>
                    </div>
                    <hr>
                    <h3>Answers</h3>
                    <div class="form-group">
                        <label for="url" class="form-label text-muted">Url:</label>
                        <input type="text" id="url" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="answer" class="form-label text-muted">Answer:</label>
                        <textarea type="text" id="answer" rows="6" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable({
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    responsive: true,
                    serverSide: true,

                    language: {
                        processing: `<div class="text-center">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                            </div>`
                    },

                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                    ajax: {
                        url: "{{ route('admin.task_answer.index') }}",
                        type: "GET",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'user_name',
                            name: 'user_name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'module_name',
                            name: 'module_name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'course_name',
                            name: 'course_name',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        function showDetails(id) {
            axios.get("{{ route('admin.survay-question.single', ':id') }}".replace(':id', id))
                .then(function(response) {
                    if (response.data.success) {
                        let data = response.data.data;
                        console.log(data);

                        document.getElementById('userName').value = data.user.firstName + data.user.lastName;
                        document.getElementById('courseName').value = data.module.course.name;
                        document.getElementById('moduleTitle').value = data.module.title;
                        document.getElementById('url').value = data.url;
                        document.getElementById('answer').value = data.answer;

                    } else {
                        toastr.error('Failed to load subscription data.');
                    }
                })
                .catch(function(error) {
                    // Check if error response exists and show the relevant message
                    const errorMessage = error.response && error.response.data && error.response.data.message ?
                        error.response.data.message :
                        'An error occurred while loading subscription data.';
                    toastr.error(errorMessage);
                });
        }
    </script>
@endpush
