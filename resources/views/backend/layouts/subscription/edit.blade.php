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
                    <form action="{{ route('admin.subscription.update', $data->id) }}" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <label for="type" class="mb-2 text-bold">Type</label>
                                <select name="type" id="type"
                                    class="form-select @error('type') text-danger @enderror" placeholder="Select Type">
                                    <option value="free" @if ($data->type == 'free') selected @endif>Free</option>
                                    <option value="premium" @if ($data->type == 'premium') selected @endif>Premium
                                    </option>
                                </select>
                                @error('type')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="mb-2 mt-4 text-bold">Price</label>
                                <input type="text" name="price" id="price" value="{{ $data->price }}"
                                    class="form-control @error('price') text-danger @enderror" placeholder="Enter Price">
                                @error('price')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="expire_date" class="mb-2 mt-4 text-bold">Expire Date</label>
                                <input type="date" name="expire_date" id="expire_date"
                                    value="{{ $data->expire_at->format('Y-m-d') }}"
                                    class="form-control @error('expire_date') text-danger @enderror"
                                    placeholder="Enter Date">
                                @error('expire_date')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h4>Subscription Details</h4>
                                    <div id="subscription_details_container">
                                        @foreach ($data->details as $item)
                                            <div class="card">
                                                <div class="card-details pb-2">
                                                    <div class="col-md-12">
                                                        <label for="title" class="mb-2 mt-4 text-bold">Enter
                                                            Title</label>
                                                        <input type="text" name="title" id="title"
                                                            value="{{ $item->title }}"
                                                            class="form-control @error('title') text-danger @enderror"
                                                            placeholder="Enter Title">
                                                        @error('title')
                                                            <span>{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="description" class="mb-2 mt-4 text-bold">Enter
                                                            Description</label>
                                                        <textarea name="description" id="description" class="form-control @error('description') text-danger @enderror"
                                                            rows="5" placeholder="Enter Description">{{ $item->description }}</textarea>
                                                        @error('description')
                                                            <span>{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <button type="button" id="subscription_details_remove"
                                                        class="btn btn-danger btn-sm mt-3 ms-2">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="card" id="subscription_details_card">
                                            <div class="card-details pb-2">
                                                <div class="col-md-12">
                                                    <label for="title" class="mb-2 mt-4 text-bold">Enter
                                                        Title</label>
                                                    <input type="text" name="title" id="title"
                                                        class="form-control @error('title') text-danger @enderror"
                                                        placeholder="Enter Title">
                                                    @error('title')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="description" class="mb-2 mt-4 text-bold">Enter
                                                        Description</label>
                                                    <textarea name="description" id="description" class="form-control @error('description') text-danger @enderror"
                                                        rows="5" placeholder="Enter Description"></textarea>
                                                    @error('description')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="button" id="subscription_details_remove"
                                                    class="btn btn-danger btn-sm mt-3 ms-2">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
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
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>
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
            // Function to add a new subscription detail card
            $('#subscription_details_add').click(function() {
                // Clone the first card
                var newCard = $('#subscription_details_card:first').clone();

                // Clear the input fields in the cloned card
                newCard.find('input').val('');
                newCard.find('textarea').val('');

                // Append the cloned card to the container
                $('#subscription_details_container').append(newCard);
            });

            // Function to remove a subscription detail card
            $(document).on('click', '#subscription_details_remove', function() {
                $(this).closest('#subscription_details_card').remove();
            });
        });
    </script>
@endpush
