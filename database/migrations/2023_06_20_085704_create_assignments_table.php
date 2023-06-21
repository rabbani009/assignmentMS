<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('assignment')->nullable();
            $table->date('assign_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->unsignedBigInteger('assignment_id')->unique();
            $table->string('subject')->nullable();
            $table->string('attached_file')->nullable();
            $table->text('assignment_description')->nullable();
            $table->unsignedTinyInteger('assignment_status')->comment('0=completed,1=Running')->default(1);
            $table->unsignedTinyInteger('status')->comment('0=Inactive,1=Active')->default(1);  
            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
