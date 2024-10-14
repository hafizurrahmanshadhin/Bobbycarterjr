@extends('backend.app')

@section('title', 'Courses')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Courses</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course List</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom"
                    style="margin-bottom: 0; display: flex; justify-content: space-between;">
                    <h3 class="card-title">Course List</h3>

                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <a class="btn btn-primary" href="">Add Module</a>
                    </div>

                    <a class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal"
                        href="javascript:void(0)" onclick="showCreateModal()">Add New</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Course Type</th>
                                    <th class="wd-15p border-bottom-0">Course Name</th>
                                    <th class="wd-15p border-bottom-0">Course Image</th>
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

    {{-- CREATE MODAL --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">
                        <i class="bi bi-plus-circle"></i> Create Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Course Type Dropdown --}}
                    <div class="form-group">
                        <label for="courseType" class="form-label text-muted">Select Course Type:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                            <select id="courseType" class="form-select">
                                <option value="" disabled selected>Select a Course Type</option>
                                {{-- Course types will be dynamically loaded here --}}
                            </select>
                        </div>
                        <small id="courseTypeHelp" class="form-text text-muted">Choose the course type from the
                            list.</small>
                    </div>

                    {{-- Course Name Input --}}
                    <div class="form-group mt-3">
                        <label for="courseName" class="form-label text-muted">Course Name:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-bookmark-plus"></i></span>
                            <input type="text" id="courseName" class="form-control" placeholder="Enter Course Name">
                        </div>
                        <small id="courseNameHelp" class="form-text text-muted">Enter the name of the course.</small>
                    </div>

                    {{-- Course Image Input --}}
                    <div class="form-group mt-3">
                        <label for="CourseImage" class="form-label text-muted">Course Image:</label>
                        <div class="input-group">
                            <input type="file" id="CourseImage" class="form-control">
                        </div>
                        <small id="editCourseNameHelp" class="form-text text-muted">Select course image.</small>
                    </div>

                    <div id="createFeedback" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="storeCourse()"><i class="bi bi-check-circle"></i> Save</button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="bi bi-pencil-square"></i> Edit Course
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Course Type Dropdown --}}
                    <div class="form-group">
                        <label for="editCourseType" class="form-label text-muted">Select Course Type:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                            <select id="editCourseType" class="form-select">
                                <option value="" disabled selected>Select a Course Type</option>
                                {{-- Course types will be dynamically loaded here --}}
                            </select>
                        </div>
                        <small id="editCourseTypeHelp" class="form-text text-muted">Choose the course type from the
                            list.</small>
                    </div>

                    {{-- Course Name Input --}}
                    <div class="form-group mt-3">
                        <label for="editCourseName" class="form-label text-muted">Course Name:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-bookmark-plus"></i></span>
                            <input type="text" id="editCourseName" class="form-control"
                                placeholder="Enter Course Name">
                        </div>
                        <small id="editCourseNameHelp" class="form-text text-muted">Enter the name of the course.</small>
                    </div>

                    {{-- Course Image Input --}}
                    <div class="form-group mt-3">
                        <label for="updateCourseImage" class="form-label text-muted">Course Image:</label>
                        <div class="input-group">
                            <input type="file" id="updateCourseImage" class="form-control">
                        </div>
                        <small id="editCourseNameHelp" class="form-text text-muted">Select course image.</small>
                        <img src="" alt="Preview" width="100" id="editPreviewImage" class="mt-2">
                    </div>
                    <input type="hidden" id="editCourseId">
                    <div id="editFeedback" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateCourse()"><i class="bi bi-save"></i> Update</button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Get the CSRF token from the meta tag
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content');

        document.addEventListener('DOMContentLoaded', function() {
            // Populate course type dropdown
            function loadCourseTypes(selectElementId, selectedValue = null) {
                axios.get("{{ route('course-types.list') }}")
                    .then(function(response) {
                        if (response.data.success) {
                            let options = '<option value="" disabled selected>Select a Course Type</option>';
                            response.data.data.forEach(function(courseType) {
                                options +=
                                    `<option value="${courseType.id}">${courseType.name}</option>`;
                            });
                            document.getElementById(selectElementId).innerHTML = options;
                            if (selectedValue) {
                                document.getElementById(selectElementId).value = selectedValue;
                            }
                        } else {
                            toastr.error('Failed to load course types.');
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while loading course types.');
                    });
            }

            // Show create modal and load course types
            window.showCreateModal = function() {
                document.getElementById('courseName').value = '';
                loadCourseTypes('courseType');
                $('#createModal').modal('show');
            }

            // Store course
            window.storeCourse = function() {
                let courseTypeId = document.getElementById('courseType').value;
                let courseName = document.getElementById('courseName').value;
                let courseImage = document.getElementById('CourseImage').files[0];

                // Validate input
                if (!courseTypeId || !courseName.trim()) {
                    toastr.error('Please select a course type and enter a course name.');
                    return;
                }

                // Create FormData object
                let formData = new FormData();
                formData.append('course_type_id', courseTypeId);
                formData.append('name', courseName);

                // Append the image file if it exists
                if (courseImage) {
                    formData.append('image', courseImage);
                }

                // Make the POST request
                axios.post("{{ route('course.store') }}", formData)
                    .then(function(response) {
                        if (response.data.success) {
                            // Hide modal and refresh the datatable
                            $('#createModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();

                            // Show success message
                            toastr.success(response.data.message);

                            // Reset the form fields
                            document.getElementById('courseType').value = '';
                            document.getElementById('courseName').value = '';
                            document.getElementById('CourseImage').value = '';
                        } else {
                            // Handle any error messages returned from the server
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(function(error) {
                        // Extract error message or set a default one
                        let errorMessage = error.response?.data?.message ||
                            'An error occurred while storing the data.';
                        toastr.error(errorMessage);
                    });
            };

            // Show edit modal and load course data
            window.editCourse = function(id) {
                axios.get("{{ route('course.edit', ':id') }}".replace(':id', id))
                    .then(function(response) {
                        if (response.data.success) {
                            let course = response.data.data;
                            document.getElementById('editCourseName').value = course.name;
                            document.getElementById('editPreviewImage').src = course
                                .image_url; // Set image preview
                            loadCourseTypes('editCourseType', course
                                .course_type_id); // Load course types and set selected value
                            document.getElementById('editCourseId').value = course.id;
                            $('#editModal').modal('show');
                        } else {
                            toastr.error('Failed to load course data.');
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while loading course data.');
                    });
            }

            // Update course
            window.updateCourse = function() {
                let courseId = document.getElementById('editCourseId').value;
                let courseTypeId = document.getElementById('editCourseType').value;
                let courseName = document.getElementById('editCourseName').value;
                let courseImage = document.getElementById('updateCourseImage').files[0];

                // Validate input
                if (!courseTypeId || !courseName.trim()) {
                    toastr.error('Please select a course type and enter a course name.');
                    return;
                }

                // Create FormData object
                let formData = new FormData();
                formData.append('course_type_id', courseTypeId);
                formData.append('name', courseName);

                // Append the image file if it exists
                if (courseImage) {
                    formData.append('image', courseImage);
                }

                // Make the PUT request
                axios.put("{{ route('course.update', ':id') }}".replace(':id', courseId), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data' // Ensure correct content type
                        }
                    })
                    .then(function(response) {
                        if (response.data.success) {
                            $('#editModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(function(error) {
                        let errorMessage = error.response?.data?.message ||
                            'An error occurred while updating the data.';
                        toastr.error(errorMessage);
                    });
            }


            // Status Change Confirm Alert
            window.showStatusChangeAlert = function(id) {
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
            window.statusChange = function(id) {
                axios.get("{{ route('course.status', ':id') }}".replace(':id', id))
                    .then(function(response) {
                        $('#datatable').DataTable().ajax.reload();
                        if (response.data.success) {
                            toastr.success(response.data.message);
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while updating the status.');
                    });
            }

            // Delete Confirmation Alert
            window.showDeleteConfirm = function(id) {
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
                        deleteCourse(id);
                    }
                });
            }

            // Delete Data
            window.deleteCourse = function(id) {
                axios.delete("{{ route('course.destroy', ':id') }}".replace(':id', id))
                    .then(function(response) {
                        if (response.data.success) {
                            $('#datatable').DataTable().ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while deleting the data.');
                    });
            }

            // Initialize DataTable
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
                    url: "{{ route('course.index') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'courseType',
                        name: 'courseType',
                        orderable: true,
                        searchable: true
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
        });
    </script>
@endpush
