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
                            <h1 class="mb-4">Add Article</h1>
                            <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="course_name" class="form-label">Course Name</label>
                                    <select name="course_name" id="course_name"
                                        class="form-select @error('title') is-invalid @enderror">
                                        <option value="">Select Course Name</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="summernote" class="form-label">Description</label>
                                    <textarea name="description" rows="8" id="summernote"
                                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror dropify">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="mark" class="form-label">Mark</label>
                                    <input type="text" name="mark" id="mark"
                                        class="form-control @error('mark') is-invalid @enderror" placeholder="Enter Mark"
                                        value="{{ old('mark') }}">
                                    <span class="text-danger error-text mark_error"></span>
                                </div>

                                <div>
                                    <label for="file" class="form-label">File</label>
                                    <input type="file" name="file" id="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                        value="{{ old('file') }}" accept=".mp3,.wav,.ogg">
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="mt-2">
                                        <audio id="audioPreview" style="display: none" controls>
                                            <source id="audioSource" src="" type="">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                                <input type="hidden" name="audio_duration" id="audio_duration" />
                                @error('audio_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

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

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file');
            const audioPreview = document.getElementById('audioPreview');
            const audioSource = document.getElementById('audioSource');
            const audioDurationInput = document.getElementById('audio_duration');

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                const audio = new Audio(URL.createObjectURL(file));

                audio.addEventListener('loadedmetadata', () => {
                    audioDurationInput.value = audio.duration;
                });

                if (file) {
                    const url = URL.createObjectURL(file);
                    audioSource.src = url;
                    audioSource.type = file.type; // Set the correct MIME type
                    audioPreview.load(); // Load the new audio source
                    audioPreview.style.display = 'block'; // Show the audio element
                } else {
                    audioPreview.style.display = 'none'; // Hide the audio element if no file
                }
            });
        </script>
    @endpush
@endsection
