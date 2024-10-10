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
                                        <td>{{ $item->expire_at->format('d-M-y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.subscription.edit', $item->id) }}"
                                                class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
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
@endsection
