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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->text('profile_image')->nullable();
            $table->string('password');
            $table->enum('user_type', ['system', 'teacher', 'student'])->default('system');
            $table->unsignedTinyInteger('belongs_to')->default(0)->comment('0=SYSTEM 1=TEACHER and 2=STUDENT. User belongs to council except 0');
            $table->unsignedTinyInteger('role_id');
            $table->longText('accesses')->nullable()->comment('All the named routes will be the accesses for roles');
            $table->string('permissions')->nullable()->comment('Create,Read,Update,Delete will be the permissions');
            $table->rememberToken();

            $table->unsignedTinyInteger('status')->comment('0=Inactive,1=Active');
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
        Schema::dropIfExists('users');
    }
};
