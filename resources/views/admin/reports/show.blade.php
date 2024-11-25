@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.report.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.id') }}
                            </th>
                            <td>
                                {{ $report->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.title') }}
                            </th>
                            <td>
                                {{ $report->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.cover_image') }}
                            </th>
                            <td>
                                @if ($report->cover_image)
                                    <a href="{{ $report->cover_image->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $report->cover_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.author') }}
                            </th>
                            <td>
                                {{ $report->author->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.report.fields.category') }}
                            </th>
                            <td>
                                {{ $report->category->title ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
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
                <a class="nav-link" href="#report_chapters" role="tab" data-toggle="tab">
                    {{ trans('cruds.chapter.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="report_chapters">
                @includeIf('admin.reports.relationships.reportChapters', [
                    'chapters' => $report->reportChapters,
                ])
            </div>
        </div>
    </div>
@endsection
