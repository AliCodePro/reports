<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id')->nullable();
            $table->foreign('report_id', 'report_fk_10284796')->references('id')->on('reports');
        });
    }
}
