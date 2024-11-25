@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.chapter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.chapters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.chapter.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="report_id">{{ trans('cruds.chapter.fields.report') }}</label>
                <select class="form-control select2 {{ $errors->has('report') ? 'is-invalid' : '' }}" name="report_id" id="report_id" required>
                    @foreach($reports as $id => $entry)
                        <option value="{{ $id }}" {{ old('report_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('report'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.report_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.chapter.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number" name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.chapter.fields.number_helper') }}</span>
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