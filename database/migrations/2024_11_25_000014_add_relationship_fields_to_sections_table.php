<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSectionsTable extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->nullable();
            $table->foreign('report_id', 'report_fk_10284790')->references('id')->on('reports');
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->foreign('chapter_id', 'chapter_fk_10284802')->references('id')->on('chapters');
        });
    }
}
