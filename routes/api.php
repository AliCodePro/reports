<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Report
    Route::post('reports/media', 'ReportApiController@storeMedia')->name('reports.storeMedia');
    Route::apiResource('reports', 'ReportApiController');

    // Category
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Faq
    Route::post('faqs/media', 'FaqApiController@storeMedia')->name('faqs.storeMedia');
    Route::apiResource('faqs', 'FaqApiController');

    // Section
    Route::post('sections/media', 'SectionApiController@storeMedia')->name('sections.storeMedia');
    Route::apiResource('sections', 'SectionApiController');

    // Chapter
    Route::apiResource('chapters', 'ChapterApiController');
});
