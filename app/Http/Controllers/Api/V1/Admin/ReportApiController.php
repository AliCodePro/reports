<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\Admin\ReportResource;
use App\Models\Report;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportResource(Report::with(['author', 'category'])->get());
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        if ($request->input('cover_image', false)) {
            $report->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover_image'))))->toMediaCollection('cover_image');
        }

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportResource($report->load(['author', 'category']));
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

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
