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
        Schema::table('courses', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            if (Schema::hasColumn('courses', 'course_subtitle')) {
                $table->text('course_subtitle')->nullable()->change();
            }
            if (Schema::hasColumn('courses', 'description_subtitle')) {
                $table->text('description_subtitle')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('title', 255)->change();
            if (Schema::hasColumn('courses', 'course_subtitle')) {
                $table->string('course_subtitle', 255)->nullable()->change();
            }
            if (Schema::hasColumn('courses', 'description_subtitle')) {
                $table->string('description_subtitle', 255)->nullable()->change();
            }
        });
    }
};
