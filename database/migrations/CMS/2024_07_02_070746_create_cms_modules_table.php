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
        Schema::create('cms_modules', function (Blueprint $table) {
            $table->id();
            $table->string('title_admin');
            $table->string('title_user');
            $table->string('sub_title_user')->nullable();
            $table->text('desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('background')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('cta_url_title')->nullable();
            $table->string('cta_icon')->nullable();
            $table->json('data')->nullable();
            $table->foreignId('design_id')->nullable()->constrained(table: 'cms_designs')->onUpdate('cascade')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_modules');
    }
};
