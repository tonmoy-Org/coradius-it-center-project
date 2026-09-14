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
        Schema::table('success_stories', function (Blueprint $table) {
            if (!Schema::hasColumn('success_stories', 'video_media_id')) {
                $table->unsignedBigInteger('video_media_id')->nullable()->after('video');
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
        Schema::table('success_stories', function (Blueprint $table) {
            if (Schema::hasColumn('success_stories', 'video_media_id')) {
                $table->dropColumn('video_media_id');
            }
        });
    }
};
