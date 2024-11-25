<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Category;
use App\Models\Report;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reports = Report::with(['author', 'category', 'media'])->get();

        $users = User::get();

        $categories = Category::get();

        return view('admin.reports.index', compact('categories', 'reports', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reports.create', compact('authors', 'categories'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        if ($request->input('cover_image', false)) {
            $report->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover_image'))))->toMediaCollection('cover_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $report->id]);
        }

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('author', 'category');

        return view('admin.reports.edit', compact('authors', 'categories', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        if ($request->input('cover_image', false)) {
            if (! $report->cover_image || $request->input('cover_image') !== $report->cover_image->file_name) {
                if ($report->cover_image) {
                    $report->cover_image->delete();
                }
                $report->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover_image'))))->toMediaCollection('cover_image');
            }
        } elseif ($report->cover_image) {
            $report->cover_image->delete();
        }

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('author', 'category', 'reportChapters');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        $reports = Report::find(request('ids'));

        foreach ($reports as $report) {
            $report->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('report_create') && Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Report();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
