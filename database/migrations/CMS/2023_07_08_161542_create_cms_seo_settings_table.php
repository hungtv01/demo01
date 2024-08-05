<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_seo_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_image');
            $table->string('meta_keywords');
            $table->morphs('seoable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_seo_settings');
    }
};
