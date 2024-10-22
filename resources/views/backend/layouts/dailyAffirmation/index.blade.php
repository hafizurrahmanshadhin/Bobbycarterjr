@extends('backend.app')

@section('title', 'Daily Affirmation')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Daily Affirmation</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daily Affirmation</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="page-title mb-3">Daily Affirmation</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Notification</th>
                                    <th class="wd-15p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->notification }}</td>
                                        <td>
                                            <a href="#viewModal" onclick="ViewDataModal({{ $item->id }})"
                                                class="btn btn-primary fs-14 text-white edit-icn" data-bs-toggle="modal"
                                                title="Edit" aria-label="Edit item {{ $item->id }}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
                        <i class="bi bi-eye"></i> Edit Daily Affirmation
                    </h5>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 550px; overflow: auto; width: 100%;">
                    <form id="FromID" action="{{ route('admin.daily_affirmation.update') }}" method="POST">
                        <div class="form-group">
                            <label for="notification" class="form-label text-muted">Notification:</label>
                            <textarea rows="5" id="notification" name="notification" placeholder="Enter Notification" class="form-control"></textarea>
                            <span class="text-danger error-text notification_error"></span>
                        </div>
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <button id="FromButton" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function ViewDataModal(id) {
            const url = `{{ route('admin.daily_affirmation.single', ':id') }}`.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    if (response.data.success) {
                        const data = response.data.data;

                        // Check if elements exist before updating
                        const notificationInput = document.getElementById('notification');
                        const idInput = document.getElementById('id');

                        if (notificationInput && idInput) {
                            notificationInput.value = data.notification;
                            idInput.value = data.id;
                        } else {
                            toastr.error('Input elements not found.');
                        }
                    } else {
                        toastr.error('Failed to load subscription data.');
                    }
                })
                .catch(function(error) {
                    // Enhanced error handling
                    const errorMessage = error.response && error.response.data && error.response.data.message ?
                        error.response.data.message :
                        'An error occurred while loading subscription data.';
                    console.error('Error loading data:', error); // Log error for debugging
                    toastr.error(errorMessage);
                });
        }
    </script>


    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#FromID").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.daily_affirmation.update') }}",
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                        $('#FromButton').attr('disabled', true).text('Loading...');
                    },
                    success: function(data) {
                        if (data.status == 0) {

                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });

                            $('#FromButton').removeAttr('disabled').text('Save');

                        } else {
                            toastr.success(data.msg);
                            $('#FromButton').removeAttr('disabled').text('Save');
                            $('#viewModal').modal('hide');
                        }
                    }
                });
            });
        });
    </script>
@endpush
