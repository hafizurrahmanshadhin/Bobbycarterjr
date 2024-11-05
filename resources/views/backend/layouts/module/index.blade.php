@extends('backend.app')

@section('title', 'Course Module')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Course Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course Module</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}
    {{-- {{ dd($data) }} --}}
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom"
                    style="margin-bottom: 0; display: flex; justify-content: space-between;">
                    <div>
                        <label for="options">
                            <b>Select Course</b>
                        </label>
                        <select id="options" class="form-select form-select-lg" style="border: 1px solid #8fbd56">
                            @foreach ($course as $filterCourse)
                                <option value="{{ $filterCourse->id }}">{{ $filterCourse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <h3 class="mb-0">Course Modules</h3>

                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.module.create') }}">Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered dataTables_wrapper dt-bootstrap5 no-footer" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Title</th>
                                    <th class="wd-15p border-bottom-0">Duration</th>
                                    <th class="wd-15p border-bottom-0">Module</th>
                                    <th class="wd-15p border-bottom-0">Mark</th>
                                    <th class="wd-15p border-bottom-0">Status</th>
                                    <th class="wd-15p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
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
                        <i class="bi bi-eye"></i> View Single Module
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="courseName" class="form-label text-muted">Course Name:</label>
                        <input type="text" id="courseName" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="title" class="form-label text-muted">Title:</label>
                        <input type="text" id="title" class="form-control" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="mark" class="form-label text-muted">Mark:</label>
                        <input type="text" id="mark" class="form-control" readonly>
                    </div>
                    <div id="contentModule">
                        <div class="form-group mt-3">
                            <label for="content" class="form-label text-muted">Content:</label>
                            <textarea rows="7" id="content" class="form-control" readonly></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="duration" class="form-label text-muted">Duration:</label>
                            <input type="text" id="duration" class="form-control" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="audio" class="form-label text-muted">Audio:</label>
                            <audio src="" id="audio" controls></audio>
                        </div>
                    </div>
                    <div id="examModule">
                        <div class="form-group mt-3">
                            <div class="p-3 border" style="background: rgba(228,231,236,.35)">
                                <div class="badge bg-primary">Question Module</div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="question" class="form-label text-muted">Question:</label>
                            <textarea rows="7" id="question" class="form-control" readonly></textarea>
                        </div>
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
                var dTable = $('#datatable').DataTable({
                    order: [],
                    lengthMenu: false,
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    paging: false,

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
                        url: "{{ route('admin.course.module.index') }}",
                        type: "GET",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'audio_time',
                            name: 'audio_time',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'module',
                            name: 'module',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'mark',
                            name: 'mark',
                            orderable: false,
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

                $('#options').change(function() {
                    var courseId = $(this).val();
                    if (courseId) {
                        // Update the DataTable's AJAX source and reload data
                        dTable.ajax.url("{{ route('admin.course.module.index') }}?id=" + courseId).load();
                    }
                });
                var courseId = $('#options').val();
                if (courseId) {
                    dTable.ajax.url("{{ route('admin.course.module.index') }}?id=" + courseId).load();
                }
            }
        });

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
            let url = '{{ route('admin.course.module.status', ':id') }}';
            $.ajax({
                type: "POST",
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

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
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
                    deleteItem(id);
                }
            });
        }

        // Delete Button
        function deleteItem(id) {
            let url = '{{ route('admin.course.module.destroy', ':id') }}';
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "POST",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp['t-success']) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    </script>

    <script>
        // Function to view module details
        window.viewModule = function(id) {

            axios.get("{{ route('admin.course.module.single', ':id') }}".replace(':id', id))
                .then(function(response) {
                    if (response.data.success) {
                        let module = response.data.data;
                        console.log(module);
                        document.getElementById('courseName').value = module.course.name;
                        document.getElementById('title').value = module.title;
                        document.getElementById('mark').value = module.mark;
                        document.getElementById('content').value = module.content;

                        const audioTime = module.audio_time; // Assuming this is in seconds

                        if (audioTime < 60) {
                            /// Show duration in whole seconds
                            const wholeSeconds = Math.floor(audioTime);
                            document.getElementById('duration').value =
                                `${wholeSeconds} second${wholeSeconds !== 1 ? 's' : ''}`;
                        } else {
                            // Convert to minutes
                            const minutes = Math.floor(audioTime / 60);
                            document.getElementById('duration').value =
                                `${minutes} minute${minutes !== 1 ? 's' : ''}`.trim();
                        }

                        const domainName = window.location.origin;
                        let audioURL = `${domainName}/${module.file_url}`;
                        document.getElementById('audio').src = audioURL;

                        document.getElementById('question').value = module.question;

                        if (module.is_exam === 1) {
                            document.getElementById('examModule').style.display = 'block';
                            document.getElementById('contentModule').style.display =
                                'none'; // Hide content module if it's an exam
                        } else {
                            document.getElementById('contentModule').style.display = 'block';
                            document.getElementById('examModule').style.display =
                                'none'; // Hide exam module if it's not an exam
                        }


                        $('#viewModal').modal('show');
                    } else {
                        toastr.error('Failed to load survey question data.');
                    }
                })
                .catch(function() {
                    toastr.error('An error occurred while loading survey question data.');
                })
        }
    </script>

    <script>
        $(document).ready(function() {
            var $modules = $('#sortable');

            $modules.sortable({
                connectWith: '#sortable', // Make sure your other lists have this too, if needed
                items: 'tr', // You are sorting rows, so target tr elements
                stop: function(event, ui) {
                    var $target = $(event.target);
                    var $parent = $(ui.item).parent();

                    // Send the request after sorting
                    sendModuleSortableRequest($parent);

                    // Handle empty message visibility when no items exist after sorting
                    if ($target.data('id') !== $parent.data('id')) {
                        if ($target.find('tr').length) {
                            sendModuleSortableRequest($target);
                        } else {
                            $target.find('.empty-message').show();
                        }
                    }
                }
            });

            $('table, #sortable').disableSelection();
        });

        function sendModuleSortableRequest($category) {

            var items = $category.sortable('toArray', {
                attribute: 'id'
            }).filter(item => item !== "");

            var orders = items.map((item, index) => index + 1);

            var idOrderMap = items.reduce((acc, id, index) => {
                acc[id] = orders[index];
                return acc;
            }, {});

            console.log(items, orders, idOrderMap);


            var data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ids: idOrderMap,
                course_id: $('#options').val()
            };

            // Perform the AJAX request to update the sorting on the server
            $.ajax({
                url: "{{ route('admin.course.module.sort') }}", // Update this if needed
                type: "POST",
                data: data,
                success: function(response) {
                    console.log('Successfully updated the sort order!');
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while updating the data.');
                    console.error('AJAX Error:', error);
                }
            });
        }
    </script>
    {{-- if ($category.find('tr.meal').length) {
        $category.find('.empty-message').hide();
    }
    $category.find('.category-name').text($category.find('tr:first td').text()); --}}
@endpush
