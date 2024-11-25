@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.chapter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.id') }}
                        </th>
                        <td>
                            {{ $chapter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.title') }}
                        </th>
                        <td>
                            {{ $chapter->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.report') }}
                        </th>
                        <td>
                            {{ $chapter->report->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.chapter.fields.number') }}
                        </th>
                        <td>
                            {{ $chapter->number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#chapter_sections" role="tab" data-toggle="tab">
                {{ trans('cruds.section.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="chapter_sections">
            @includeIf('admin.chapters.relationships.chapterSections', ['sections' => $chapter->chapterSections])
        </div>
    </div>
</div>

@endsection