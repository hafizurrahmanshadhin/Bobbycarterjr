@extends('backend.app')

@section('title', 'Subscription')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Subscription</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Subscription</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Type</th>
                                    <th class="wd-15p border-bottom-0">Price</th>
                                    <th class="wd-15p border-bottom-0">Expire Time</th>
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
                                        <td>
                                            <span class="badge bg-info">
                                                {{ ucfirst($item->type) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->price ?? 'Free' }}</td>
                                        <td>{{ $item->expire_at }} @if ($item->type == 'free')
                                                Day
                                            @else
                                                Month
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.subscription.edit', $item->id) }}"
                                                class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <button onclick="ViewDataModal({{ $item->id }})"
                                                class="btn btn-info fs-14 text-white edit-icn" data-bs-target="#viewModal"
                                                data-bs-toggle="modal" title="View">
                                                <i class="fe fe-eye"></i>
                                            </button>
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
                        <i class="bi bi-eye"></i> View Subscription Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 550px; overflow: auto; width: 100%;">
                    <div class="form-group">
                        <label for="viewType" class="form-label text-muted">Type:</label>
                        <input type="text" id="viewType" class="form-control" readonly>
                    </div>
                    <div class="mt-3 row">
                        <div class="col-md-6">
                            <label for="viewPrice" class="form-label text-muted">Price:</label>
                            <input type="text" id="viewPrice" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="viewExpireDate" class="form-label text-muted">Expire Date(<span
                                    id="typeDayMonthChange"></span>):</label>
                            <input type="text" id="viewExpireDate" class="form-control" readonly>
                        </div>
                    </div>
                    <h3 class="mt-3">Subscription Details:</h3>
                    <div class="card-groups" id="cardGroups">

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
        function ViewDataModal(id) {
            axios.get("{{ route('admin.subscription.single', ':id') }}".replace(':id', id))
                .then(function(response) {
                    if (response.data.success) {
                        let data = response.data.data;
                        document.getElementById('viewType').value = data.type;

                        if (data.type === 'free') {
                            typeDayMonthChange.textContent = 'Day'; // Set to 'Day' for free
                        } else if (data.type === 'premium') {
                            typeDayMonthChange.textContent = 'Month'; // Set to 'Month' for premium
                        }

                        document.getElementById('viewPrice').value = data.price !== null ? data.price : 'Free';
                        document.getElementById('viewExpireDate').value = data.expire_at;

                        let viewOptionsContainer = document.getElementById('cardGroups');
                        viewOptionsContainer.innerHTML = ''; // Clear existing options
                        data.details.forEach(function(option) { // Use 'data' instead of 'question'
                            let optionItem = `
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="viewCourse" class="form-label text-muted">Title:</label>
                                            <input type="text" id="viewCourse" value='${option.title}' class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="viewCourse" class="form-label text-muted">Description:</label>
                                            <textarea id="viewCourse" rows="5" class="form-control" readonly>${option.description}</textarea>
                                        </div>
                                    </div>
                                </div>`;
                            viewOptionsContainer.insertAdjacentHTML('beforeend', optionItem);
                        });
                        console.log();

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
