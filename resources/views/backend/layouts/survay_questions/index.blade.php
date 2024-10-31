@extends('backend.app')

@section('title', 'Survey Questions')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style>
        #viewOptions .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 5px;
        }
    </style>
@endpush

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Survey Questions</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Survey Question List</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header border-bottom"
                    style="margin-bottom: 0; display: flex; justify-content: space-between;">
                    <h3 class="card-title">Survey Question List</h3>
                    <a class="btn btn-primary" data-bs-target="#createModal" data-bs-toggle="modal"
                        href="javascript:void(0)" onclick="showCreateModal()">Add New</a>
                </div> --}}

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Course</th>
                                    <th class="wd-15p border-bottom-0">Question</th>
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

    {{-- VIEW MODAL --}}
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">
                        <i class="bi bi-eye"></i> View Survey Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="viewCourse" class="form-label text-muted">Course:</label>
                        <input type="text" id="viewCourse" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="viewQuestion" class="form-label text-muted">Question:</label>
                        <input type="text" id="viewQuestion" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="viewOptions" class="form-label text-muted">Options:</label>
                        <ul id="viewOptions" class="list-group">
                            {{-- Options will be dynamically loaded here --}}
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        Close</button>
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
                        <i class="bi bi-plus-circle"></i> Create Survey Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Course Dropdown --}}
                    <div class="form-group">
                        <label for="course" class="form-label text-muted">Select Course:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                            <select id="course" class="form-select">
                                <option value="" disabled selected>Select a Course</option>
                                {{-- Courses will be dynamically loaded here --}}
                            </select>
                        </div>
                        <small id="courseHelp" class="form-text text-muted">Choose the course from the list.</small>
                        <div id="courseError" class="text-danger"></div>
                    </div>

                    {{-- Question Input --}}
                    <div class="form-group mt-3">
                        <label for="question" class="form-label text-muted">Question:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-question-circle"></i></span>
                            <input type="text" id="question" class="form-control" placeholder="Enter Question">
                        </div>
                        <small id="questionHelp" class="form-text text-muted">Enter the survey question.</small>
                        <div id="questionError" class="text-danger"></div>
                    </div>

                    {{-- Options Input --}}
                    <div class="form-group mt-3">
                        <label for="options" class="form-label text-muted">Options:</label>
                        <div id="optionsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                                <input type="text" class="form-control option-input" placeholder="Enter Option">
                                <div class="input-group-text">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="is-correct-checkbox"> Correct
                                    </label>
                                </div>
                                <button class="btn btn-danger remove-option" type="button"><i
                                        class="bi bi-x-circle"></i></button>
                            </div>
                        </div>
                        <button class="btn btn-secondary mt-2" type="button" id="addOption"><i
                                class="bi bi-plus-circle"></i> Add Option</button>
                        <div id="optionsError" class="text-danger"></div>
                        <div id="correctOptionError" class="text-danger"></div>
                    </div>
                    <div id="createFeedback" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="storeQuestion()"><i class="bi bi-check-circle"></i>
                        Save</button>
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
                        <i class="bi bi-pencil-square"></i> Edit Survey Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Course Dropdown --}}
                    <div class="form-group">
                        <label for="editCourse" class="form-label text-muted">Select Course:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                            <select id="editCourse" class="form-select">
                                <option value="" disabled selected>Select a Course</option>
                                {{-- Courses will be dynamically loaded here --}}
                            </select>
                        </div>
                        <small id="editCourseHelp" class="form-text text-muted">Choose the course from the list.</small>
                    </div>

                    {{-- Question Input --}}
                    <div class="form-group mt-3">
                        <label for="editQuestion" class="form-label text-muted">Question:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-question-circle"></i></span>
                            <input type="text" id="editQuestion" class="form-control" placeholder="Enter Question">
                        </div>
                        <small id="editQuestionHelp" class="form-text text-muted">Enter the survey question.</small>
                    </div>

                    {{-- Options Input --}}
                    <div class="form-group mt-3">
                        <label for="editOptions" class="form-label text-muted">Options:</label>
                        <div id="editOptionsContainer">
                            {{-- Options will be dynamically loaded here --}}
                        </div>
                        <button class="btn btn-secondary mt-2" type="button" id="addEditOption"><i
                                class="bi bi-plus-circle"></i> Add Option</button>
                    </div>
                    <input type="hidden" id="editQuestionId">
                    <div id="editFeedback" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateQuestion()"><i class="bi bi-save"></i> Update</button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadCourses(selectElementId, selectedValue = null) {
                axios.get("{{ route('courses.list') }}")
                    .then(function(response) {
                        if (response.data.success) {
                            let options = '<option value="" disabled selected>Select a Course</option>';
                            response.data.data.forEach(function(course) {
                                options += `<option value="${course.id}">${course.name}</option>`;
                            });
                            document.getElementById(selectElementId).innerHTML = options;
                            if (selectedValue) {
                                document.getElementById(selectElementId).value = selectedValue;
                            }
                        } else {
                            toastr.error('Failed to load courses.');
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while loading courses.');
                    });
            }


            //${option.is_correct ? '<span class="badge bg-success">Correct</span>' : ''} // this line is after <span>${option.options}</span> this line

            // Function to view survey question details
            window.viewQuestion = function(id) {
                axios.get("{{ route('survay-questions.view', ':id') }}".replace(':id', id))
                    .then(function(response) {
                        if (response.data.success) {
                            let question = response.data.data;
                            document.getElementById('viewCourse').value = question.course.name;
                            document.getElementById('viewQuestion').value = question.questions;

                            let viewOptionsContainer = document.getElementById('viewOptions');
                            viewOptionsContainer.innerHTML = '';
                            question.options.forEach(function(option) {
                                let optionItem = `
                                    <li class="list-group-item">
                                        <span>${option.options}</span>

                                    </li>`;
                                viewOptionsContainer.insertAdjacentHTML('beforeend', optionItem);
                            });

                            $('#viewModal').modal('show');
                        } else {
                            toastr.error('Failed to load survey question data.');
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while loading survey question data.');
                    });
            }


            // Show create modal and load courses
            window.showCreateModal = function() {
                document.getElementById('course').value = '';
                document.getElementById('question').value = '';
                document.getElementById('optionsContainer').innerHTML = '';
                document.getElementById('createFeedback').innerHTML = '';
                document.getElementById('courseError').innerHTML = '';
                document.getElementById('questionError').innerHTML = '';
                document.getElementById('optionsError').innerHTML = '';
                document.getElementById('correctOptionError').innerHTML = '';

                // Add a default option input
                let optionsContainer = document.getElementById('optionsContainer');
                let optionInput = `
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                        <input type="text" class="form-control option-input" placeholder="Enter Option">
                        <div class="input-group-text">
                            <label class="form-check-label">
                                <input type="checkbox" class="is-correct-checkbox"> Correct
                            </label>
                        </div>
                        <button class="btn btn-danger remove-option" type="button"><i class="bi bi-x-circle"></i></button>
                    </div>`;
                optionsContainer.insertAdjacentHTML('beforeend', optionInput);

                // Load courses
                loadCourses('course');
                $('#createModal').modal('show');
            }

            // Add new option input
            document.getElementById('addOption').addEventListener('click', function() {
                let optionsContainer = document.getElementById('optionsContainer');
                let optionInput = `
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                        <input type="text" class="form-control option-input" placeholder="Enter Option">
                        <div class="input-group-text">
                            <label class="form-check-label">
                                <input type="checkbox" class="is-correct-checkbox"> Correct
                            </label>
                        </div>
                        <button class="btn btn-danger remove-option" type="button"><i class="bi bi-x-circle"></i></button>
                    </div>`;
                optionsContainer.insertAdjacentHTML('beforeend', optionInput);
            });

            // Remove option input
            document.addEventListener('click', function(event) {
                if (event.target.closest('.remove-option')) {
                    event.target.closest('.input-group').remove();
                }
            });

            // Store survey question
            window.storeQuestion = function() {
                let courseId = document.getElementById('course').value;
                let question = document.getElementById('question').value;

                let options = [];
                let isCorrectSelected = false;
                document.querySelectorAll('#optionsContainer .input-group').forEach(function(optionGroup) {
                    let optionInput = optionGroup.querySelector('.option-input').value;
                    let isCorrect = optionGroup.querySelector('.is-correct-checkbox').checked;
                    options.push({
                        option: optionInput,
                        is_correct: isCorrect
                    });
                    if (isCorrect) {
                        isCorrectSelected = true;
                    }
                });

                // Clear previous feedback
                document.getElementById('createFeedback').innerHTML = '';
                document.getElementById('courseError').innerHTML = '';
                document.getElementById('questionError').innerHTML = '';
                document.getElementById('optionsError').innerHTML = '';
                document.getElementById('correctOptionError').innerHTML = '';

                // Validate fields
                let errors = {};
                if (!courseId) {
                    errors.course_id = ['Please select a course.'];
                }
                if (!question) {
                    errors.questions = ['Please enter a question.'];
                }
                if (options.length === 0) {
                    errors.options = ['Please add at least one option.'];
                }
                if (!isCorrectSelected) {
                    errors.correct_option = ['At least one option must be marked as correct.'];
                }

                // Display validation errors if any
                if (Object.keys(errors).length > 0) {
                    displayValidationErrors(errors);
                    return;
                }

                axios.post("{{ route('survay-questions.store') }}", {
                        course_id: courseId,
                        questions: question,
                        options: options
                    })
                    .then(function(response) {
                        if (response.data.success) {
                            $('#createModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                            toastr.success(response.data.message);
                            // Clear form fields and options container
                            document.getElementById('course').value = '';
                            document.getElementById('question').value = '';
                            document.getElementById('optionsContainer').innerHTML = '';
                            document.getElementById('createFeedback').innerHTML = '';
                        } else {
                            displayValidationErrors(response.data.data);
                        }
                    })
                    .catch(function(error) {
                        if (error.response && error.response.data && error.response.data.errors) {
                            displayValidationErrors(error.response.data.errors);
                        } else {
                            toastr.error('An error occurred while storing the data.');
                        }
                    });
            }

            // Show edit modal and load survey question data
            window.editQuestion = function(id) {
                axios.get("{{ route('survay-questions.edit', ':id') }}".replace(':id', id))
                    .then(function(response) {
                        if (response.data.success) {
                            let question = response.data.data;
                            document.getElementById('editQuestion').value = question.questions;
                            loadCourses('editCourse', question
                                .course_id);
                            document.getElementById('editQuestionId').value = question.id;

                            // Load options
                            let editOptionsContainer = document.getElementById('editOptionsContainer');
                            editOptionsContainer.innerHTML = '';
                            question.options.forEach(function(option) {
                                let optionInput = `
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                                <input type="text" class="form-control option-input" value="${option.options}" placeholder="Enter Option">
                                <div class="input-group-text">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="is-correct-checkbox" ${option.is_correct ? 'checked' : ''}> Correct
                                    </label>
                                </div>
                                <button class="btn btn-danger remove-option" type="button"><i class="bi bi-x-circle"></i></button>
                            </div>`;
                                editOptionsContainer.insertAdjacentHTML('beforeend', optionInput);
                            });

                            $('#editModal').modal('show');
                        } else {
                            toastr.error('Failed to load survey question data.');
                        }
                    })
                    .catch(function() {
                        toastr.error('An error occurred while loading survey question data.');
                    });
            }

            // Add new option input in edit modal
            document.getElementById('addEditOption').addEventListener('click', function() {
                let editOptionsContainer = document.getElementById('editOptionsContainer');
                let optionInput = `
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-list-check"></i></span>
                        <input type="text" class="form-control option-input" placeholder="Enter Option">
                        <div class="input-group-text">
                            <label class="form-check-label">
                                <input type="checkbox" class="is-correct-checkbox"> Correct
                            </label>
                        </div>
                        <button class="btn btn-danger remove-option" type="button"><i class="bi bi-x-circle"></i></button>
                    </div>`;
                editOptionsContainer.insertAdjacentHTML('beforeend', optionInput);
            });

            // Update survey question
            window.updateQuestion = function() {
                let questionId = document.getElementById('editQuestionId').value;
                let courseId = document.getElementById('editCourse').value;
                let question = document.getElementById('editQuestion').value;

                let options = [];
                let isCorrectSelected = false;
                document.querySelectorAll('#editOptionsContainer .input-group').forEach(function(optionGroup) {
                    let optionInput = optionGroup.querySelector('.option-input').value;
                    let isCorrect = optionGroup.querySelector('.is-correct-checkbox').checked;
                    options.push({
                        option: optionInput,
                        is_correct: isCorrect
                    });
                    if (isCorrect) {
                        isCorrectSelected = true;
                    }
                });

                // Clear previous feedback
                document.getElementById('editFeedback').innerHTML = '';
                document.getElementById('courseError').innerHTML = '';
                document.getElementById('questionError').innerHTML = '';
                document.getElementById('optionsError').innerHTML = '';
                document.getElementById('correctOptionError').innerHTML = '';

                // Validate fields
                let errors = {};
                if (!courseId) {
                    errors.course_id = ['Please select a course.'];
                }
                if (!question) {
                    errors.questions = ['Please enter a question.'];
                }
                if (options.length === 0) {
                    errors.options = ['Please add at least one option.'];
                }
                if (!isCorrectSelected) {
                    errors.correct_option = ['At least one option must be marked as correct.'];
                }

                // Display validation errors if any
                if (Object.keys(errors).length > 0) {
                    displayValidationErrors(errors);
                    return;
                }

                axios.put("{{ route('survay-questions.update', ':id') }}".replace(':id', questionId), {
                        course_id: courseId,
                        questions: question,
                        options: options
                    })
                    .then(function(response) {
                        if (response.data.success) {
                            $('#editModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            displayValidationErrors(response.data.data);
                        }
                    })
                    .catch(function(error) {
                        if (error.response && error.response.data && error.response.data.errors) {
                            displayValidationErrors(error.response.data.errors);
                        } else {
                            toastr.error('An error occurred while updating the data.');
                        }
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
                axios.get("{{ route('survay-questions.status', ':id') }}".replace(':id', id))
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
                        deleteQuestion(id);
                    }
                });
            }

            // Delete Data
            window.deleteQuestion = function(id) {
                axios.delete("{{ route('survay-questions.destroy', ':id') }}".replace(':id', id))
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

            // Display validation errors
            function displayValidationErrors(errors) {
                // Clear previous errors
                document.getElementById('courseError').innerHTML = '';
                document.getElementById('questionError').innerHTML = '';
                document.getElementById('optionsError').innerHTML = '';
                document.getElementById('correctOptionError').innerHTML = '';

                // Display new errors
                if (errors.course_id) {
                    document.getElementById('courseError').innerHTML = errors.course_id[0];
                }
                if (errors.questions) {
                    document.getElementById('questionError').innerHTML = errors.questions[0];
                }
                if (errors.options) {
                    document.getElementById('optionsError').innerHTML = errors.options[0];
                }
                if (errors.correct_option) {
                    document.getElementById('correctOptionError').innerHTML = errors.correct_option[0];
                }
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
                    processing: `
                        <div class="text-center">
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
                    url: "{{ route('survay-questions.index') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'course',
                        name: 'course',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'questions',
                        name: 'questions',
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
