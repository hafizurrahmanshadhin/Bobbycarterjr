@extends('backend.app')

@section('title', 'Article')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Article</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Article</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-4">Update Article</h1>
                            <form action="{{ route('admin.article.update', $data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="course_name" class="form-label">Course Name</label>
                                    <select name="course_name" id="course_name"
                                        class="form-select @error('title') is-invalid @enderror">
                                        <option value="">Select Course Name</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($data->course_id == $item->id) selected @endif>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title"
                                        value="{{ old('title', $data->title) }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" rows="8" id="description"
                                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description', $data->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror dropify"
                                        data-default-file="@isset($data){{ asset($data->image_url) }}@endisset">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <a href="{{ route('admin.article.index') }}" class="btn btn-danger">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
