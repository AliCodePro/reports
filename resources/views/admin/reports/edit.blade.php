@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.reports.update', [$report->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.report.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', $report->title) }}" required>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.report.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cover_image">{{ trans('cruds.report.fields.cover_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('cover_image') ? 'is-invalid' : '' }}"
                        id="cover_image-dropzone">
                    </div>
                    @if ($errors->has('cover_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cover_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.report.fields.cover_image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="author_id">{{ trans('cruds.report.fields.author') }}</label>
                    <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id"
                        id="author_id" required>
                        @foreach ($authors as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('author_id') ? old('author_id') : $report->author->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('author'))
                        <div class="invalid-feedback">
                            {{ $errors->first('author') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.report.fields.author_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="category_id">{{ trans('cruds.report.fields.category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                        name="category_id" id="category_id" required>
                        @foreach ($categories as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('category_id') ? old('category_id') : $report->category->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.report.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.coverImageDropzone = {
            url: '{{ route('admin.reports.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 5096,
                height: 5096
            },
            success: function(file, response) {
                $('form').find('input[name="cover_image"]').remove()
                $('form').append('<input type="hidden" name="cover_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="cover_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($report) && $report->cover_image)
                    var file = {!! json_encode($report->cover_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="cover_image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
