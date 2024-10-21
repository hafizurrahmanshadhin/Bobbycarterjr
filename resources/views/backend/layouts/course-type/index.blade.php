@extends('backend.app')

@section('title', 'Course Type')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Course Type</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course Type List</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom"
                    style="margin-bottom: 0; display: flex; justify-content: space-between;">
                    <h3 class="card-title">Course Type List</h3>
                    <a class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal"
                        href="javascript:void(0)" onclick="showCreateModal()">Add New</a>
                </div>

                {{-- CREATE MODAL START --}}
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="bi bi-plus-circle"></i> Create
                                    Course Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="createCourseTypeName" class="form-label text-muted">Course Type
                                        Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-bookmark-plus"></i></span>
                                        <input type="text" id="createCourseTypeName" class="form-control"
                                            placeholder="Enter Course Type">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="createCourseTypeImage" class="form-label text-muted">Course Type
                                        Image:</label>
                                    <input type="file" id="createCourseTypeImage" class="dropify form-control">
                                    <small class="form-text text-muted">Upload an image (JPEG, PNG, etc.).</small>
                                </div>

                                <div id="createFeedback" class="mt-2"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" onclick="storeCourseType()"><i
                                        class="bi bi-check-circle"></i> Save</button>
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- CREATE MODAL END --}}

                {{-- EDIT MODAL START --}}
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square"></i> Edit Course
                                    Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="editCourseTypeName" class="form-label text-muted">Course Type Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-bookmark-fill"></i></span>
                                        <input type="text" id="editCourseTypeName" class="form-control"
                                            placeholder="Enter Course Type">
                                        <input type="hidden" id="editCourseTypeId">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editCourseTypeImage" class="form-label text-muted">Course Type
                                        Image:</label>
                                    <input type="file" id="editCourseTypeImage" class="dropify form-control">
                                    <small class="form-text text-muted">Upload a new image if you want to change the
                                        existing one (JPEG, PNG, etc.).</small>
                                </div>

                                <div id="editFeedback" class="mt-2"></div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" onclick="updateCourseType()"><i class="bi bi-save"></i>
                                    Update</button>
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- EDIT MODAL END --}}

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Image</th>
                                    <th class="wd-15p border-bottom-0">Status</th>
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
                        url: "{{ route('course-type.index') }}",
                        type: "GET",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'status',
                            name: 'status',
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

        // Initialize Dropify
        $('.dropify').dropify();

        // storing data
        window.showCreateModal = function() {
            $('#createCourseTypeName').val('');
            $('#createCourseTypeImage').val('');
            $('#createCourseTypeImage').dropify().clearElement();
            $('#createModal').modal('show');
        }

        window.storeCourseType = function() {
            let courseName = $('#createCourseTypeName').val();
            let courseImage = $('#createCourseTypeImage').prop('files')[0];

            if (courseName.trim() === '' || !courseImage) {
                toastr.error('Please enter a course type name and upload an image.');
                return;
            }

            let formData = new FormData();
            formData.append('name', courseName);
            formData.append('image', courseImage);

            $.ajax({
                url: "{{ route('course-type.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        $('#createModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while storing the data.');
                }
            });
        }

        //Edit data
        window.editCourseType = function(id) {
            $.ajax({
                url: '{{ route('course-type.edit', ':id') }}'.replace(':id', id),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#editCourseTypeName').val(response.data.name);
                        $('#editCourseTypeId').val(response.data.id);

                        // Initialize Dropify with existing image
                        let imageUrl = `{{ asset(':image') }}`.replace(':image', response.data.image);
                        let drEvent = $('#editCourseTypeImage').dropify({
                            defaultFile: imageUrl,
                            messages: {
                                'default': 'Drag and drop a file here or click',
                                'replace': 'Drag and drop or click to replace',
                                'remove': 'Remove',
                                'error': 'Ooops, something wrong happened.'
                            }
                        });

                        // Destroy and reinitialize Dropify to update the image preview
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = imageUrl;
                        drEvent.destroy();
                        drEvent.init();

                        $('#editModal').modal('show');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while fetching the data.');
                }
            });
        }


        // update data
        window.updateCourseType = function() {
            let courseId = $('#editCourseTypeId').val();
            let courseName = $('#editCourseTypeName').val();
            let courseImage = $('#editCourseTypeImage').prop('files')[0];

            if (courseName.trim() === '') {
                toastr.error('Please enter a course type name.');
                return;
            }

            let formData = new FormData();
            formData.append('_method', 'PUT'); // Add this line to specify the HTTP method
            formData.append('name', courseName);
            if (courseImage) {
                formData.append('image', courseImage);
            }

            $.ajax({
                url: "{{ route('course-type.update', ':id') }}".replace(':id', courseId),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        $('#editModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while updating the data.');
                }
            });
        }

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change
        function statusChange(id) {
            let url = '{{ route('course-type.status', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    console.log(resp);
                    // Reloade DataTable
                    $('#datatable').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    // location.reload();
                }
            });
        }

        // Delete Confirmation Alert
        function showDeleteConfirm(id) {
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteCourseType(id);
                }
            });
        }

        // Delete Data
        function deleteCourseType(id) {
            $.ajax({
                url: '{{ route('course-type.destroy', ':id') }}'.replace(':id', id),
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $('#datatable').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while deleting the data.');
                }
            });
        }
    </script>
@endpush
