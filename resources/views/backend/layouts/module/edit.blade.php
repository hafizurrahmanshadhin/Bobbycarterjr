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

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="mb-4">Update Module</h1>
                            <form id="FromID" action="{{ route('admin.course.module.update', $data->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="ms-3 mb-4">
                                    <div class="form-check form-switch">
                                        <input style="width: 60px;height: 30px;" class="form-check-input" type="checkbox"
                                            @if ($data->is_exam == 1) checked @endif id="is_exam" name="is_exam">
                                        <label style="margin-left: 40px;margin-top: 8px;font-size: 17px; user-select: none"
                                            class="form-check-label" for="is_exam">
                                            Exam Module?</label>
                                    </div>
                                </div>

                                <hr>

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
                                    <span class="text-danger error-text course_name_error"></span>
                                </div>
                                <div>
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title"
                                        value="{{ old('title', $data->title) }}">
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                                <div id="moduleContent">
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" rows="8" id="description"
                                            class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description', $data->content ?? '') }}</textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>
                                    <div>
                                        <label for="file" class="form-label">File</label>
                                        <input type="file" name="file" id="file"
                                            class="form-control @error('file') is-invalid @enderror"
                                            value="{{ old('file') }}" accept=".mp3,.wav,.ogg">
                                        <span class="text-danger error-text file_error"></span>

                                        <div class="mt-2">
                                            <audio id="audioPreview" controls
                                                style="@if ($data->is_exam == 1) display: none @endif">
                                                <source id="audioSource" src="{{ asset($data->file_url) }}" type="">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                    <input type="hidden" name="audio_duration" id="audio_duration" />
                                </div>

                                <div id="ExamContent">
                                    <div>
                                        <label for="question" class="form-label">Question</label>
                                        <textarea name="question" rows="8" id="question" class="form-control @error('question') is-invalid @enderror"
                                            placeholder="Enter Question">{{ old('question', $data->question ?? '') }}</textarea>
                                        <span class="text-danger error-text question_error"></span>
                                    </div>
                                </div>

                                <div>
                                    <label for="mark" class="form-label">Mark</label>
                                    <input type="text" name="mark" id="mark"
                                        class="form-control @error('mark') is-invalid @enderror" placeholder="Enter Mark"
                                        value="{{ old('mark', $data->mark) }}">
                                    <span class="text-danger error-text mark_error"></span>
                                </div>

                                <div class="mt-4">
                                    <input id="FormBtn" type="submit" class="btn btn-primary" value="Submit">
                                    <a href="{{ route('admin.course.module.index') }}" class="btn btn-danger">Back</a>
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
            const is_exam_checkbox = document.getElementById('is_exam');
            const moduleContent = document.getElementById('moduleContent');
            const ExamContent = document.getElementById('ExamContent');

            if (is_exam_checkbox) {
                is_exam_checkbox.addEventListener('change', function() {
                    if (is_exam_checkbox.checked) {
                        moduleContent.style.display = 'none'; // Hide the div
                        ExamContent.style.display = 'block';
                    } else {
                        moduleContent.style.display = 'block'; // Show the div
                        ExamContent.style.display = 'none';
                    }
                });

                if (is_exam_checkbox.checked) {
                    moduleContent.style.display = 'none'; // Hide the div
                    ExamContent.style.display = 'block';
                } else {
                    moduleContent.style.display = 'block'; // Show the div
                    ExamContent.style.display = 'none';
                }
            }
        </script>

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

            $(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#FromID").on('submit', function(e) {
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
                            $('#FormBtn').attr('disabled', true).text('Loading...');
                        },
                        success: function(data) {
                            if (data.status == 1) {

                                toastr.success(data.msg);
                                $('#FormBtn').removeAttr('disabled').text('Save');

                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('admin.course.module.index') }}";
                                }, 1000);

                            } else if (data.status == 0) {
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });

                                $('#FormBtn').removeAttr('disabled').text('Save');
                            } else {
                                toastr.success(data.msg);
                                $('#FormBtn').removeAttr('disabled').text('Save');
                            }
                        }
                    });

                });
            });
        </script>
    @endpush
@endsection
