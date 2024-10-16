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
                    <h2 class="mb-4">Edit Subscription</h2>
                    <form id="SubscriptionForm" action="{{ route('admin.subscription.update', $data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="type" class="mb-2 text-bold">Type</label>
                                <select name="type" id="type"
                                    class="form-select @error('type') text-danger @enderror" placeholder="Select Type">
                                    <option value="free" @if ($data->type == 'free') selected @endif>Free</option>
                                    <option value="premium" @if ($data->type == 'premium') selected @endif>Premium
                                    </option>
                                </select>
                                <span class="text-danger error-text type_error" id="type_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="mb-2 mt-4 text-bold">Price</label>
                                <input type="text" name="price" id="price" value="{{ $data->price }}"
                                    class="form-control @error('price') text-danger @enderror" placeholder="Enter Price">
                                <span class="text-danger error-text price_error" id="price_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="expire_date" class="mb-2 mt-4 text-bold">Expire Date (<span
                                        id="typeDayMonthChange"></span>)</label>
                                <input type="text" name="expire_date" id="expire_date" value="{{ $data->expire_at }}"
                                    class="form-control @error('expire_date') text-danger @enderror"
                                    placeholder="Enter Date">
                                <span class="text-danger error-text expire_date_error" id="expire_date_error"></span>
                            </div>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4>Subscription Details</h4>
                                    <div id="subscription_details_container">
                                        @forelse ($data->details as $item)
                                            <div class="card subscription_details_card" id="subscription_details_card">
                                                <div class="card-details pb-2">
                                                    <div class="col-md-12">
                                                        <label for="title" class="mb-2 mt-4 text-bold">Enter
                                                            Title</label>
                                                        <input type="text" name="title[]" id="title"
                                                            value="{{ $item->title }}"
                                                            class="form-control @error('title') text-danger @enderror"
                                                            placeholder="Enter Title">
                                                        <span class="text-danger error-text title_error"
                                                            id="title_error"></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="description" class="mb-2 mt-4 text-bold">Enter
                                                            Description</label>
                                                        <textarea name="description[]" id="description" class="form-control @error('description') text-danger @enderror"
                                                            rows="5" placeholder="Enter Description">{{ $item->description }}</textarea>
                                                        <span class="text-danger error-text description_error"
                                                            id="description_error"></span>
                                                    </div>
                                                    <button type="button" id="subscription_details_remove"
                                                        class="btn btn-danger btn-sm mt-3 ms-2 remove-item">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="card subscription_details_card" id="subscription_details_card">
                                                <div class="card-details pb-2">
                                                    <div class="col-md-12">
                                                        <label for="title" class="mb-2 mt-4 text-bold">Enter
                                                            Title</label>
                                                        <input type="text" name="title[]" id="title"
                                                            class="form-control @error('title') text-danger @enderror"
                                                            placeholder="Enter Title">
                                                        <span class="text-danger error-text title_error"
                                                            id="title_error"></span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="description" class="mb-2 mt-4 text-bold">Enter
                                                            Description</label>
                                                        <textarea name="description[]" id="description" class="form-control @error('description') text-danger @enderror"
                                                            rows="5" placeholder="Enter Description"></textarea>
                                                        <span class="text-danger error-text description_error"
                                                            id="description_error"></span>
                                                    </div>
                                                    <button type="button" id="subscription_details_remove"
                                                        class="btn btn-danger btn-sm mt-3 ms-2 remove-item">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                    <button type="button" class="btn btn-success" id="subscription_details_add">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        <span class="d-inline-block">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" id="SubscriptionSubmit" class="btn btn-primary btn-lg">Save</button>
                            <a href="{{ route('admin.subscription.index') }}" class="btn btn-danger btn-lg">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.subscription_details_card').each(function(index) {
                $(this).find('.title_error').attr('id', `title.${index}_error`);
                $(this).find('.description_error').attr('id', `description.${index}_error`);
            });
            // Function to add a new subscription detail card
            $('#subscription_details_add').click(function() {
                // Clone the first card
                let newCard = $('#subscription_details_card:first').clone();

                // Clear the input fields in the cloned card
                newCard.find('input').val('');
                newCard.find('textarea').val('');

                // Clear previous error messages
                newCard.find('.error-text').text('');

                // Get the current number of subscription detail cards
                const currentCount = $('.subscription_details_card').length;

                // Update IDs for error messages with the new count
                newCard.find('.title_error').attr('id', `title.${currentCount}_error`);
                newCard.find('.description_error').attr('id', `description.${currentCount}_error`);

                // Append the cloned card to the container
                $('#subscription_details_container').append(newCard);
            });
        });
    </script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#SubscriptionForm").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                        $('#SubscriptionSubmit').attr('disabled', true).text('Loading...');
                    },
                    success: function(data) {
                        if (data.status == 0) {

                            $.each(data.error, function(prefix, val) {
                                var id = prefix + '_error';
                                var errorSpanTag = document.getElementById(id);
                                errorSpanTag.innerHTML = val[0];
                            });

                            $('#SubscriptionSubmit').removeAttr('disabled').text('Save');

                        } else {
                            toastr.success(data.msg);
                            $('#SubscriptionSubmit').removeAttr('disabled').text('Save');

                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('admin.subscription.index') }}";
                            }, 1000);
                        }
                    }
                });

            });
        });
    </script>

    <script>
        // Remove Subscription Details with SweetAlert
        document.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.remove-item')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover this item!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.closest('.subscription_details_card').remove();
                        Swal.fire({
                            timer: 1500,
                            icon: "success",
                            title: "Your item has been Removed.",
                            showConfirmButton: false,
                        })
                    }
                });
            }
        });
    </script>

    <script>
        // Function to update the span based on selected type
        function updateTypeText() {
            const selectElement = document.getElementById('type');
            const displaySpan = document.getElementById('typeDayMonthChange');

            if (selectElement.value === 'free') {
                displaySpan.textContent = 'Day'; // Change text to "Day"
            } else if (selectElement.value === 'premium') {
                displaySpan.textContent = 'Month'; // Change text to "Month"
            }
        }

        // Add event listener to the select element
        document.getElementById('type').addEventListener('change', updateTypeText);

        // Call the function initially to set the correct text based on the pre-selected value
        updateTypeText();
    </script>
@endpush
