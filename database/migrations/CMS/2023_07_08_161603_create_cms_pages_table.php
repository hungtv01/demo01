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
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->boolean('top_position')->default(false);
            $table->json('modules')->nullable();
            $table->boolean('is_homepage')->default(false);
            $table->integer('order')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained(table: 'cms_pages')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('handle_id')->nullable()->constrained(table: 'cms_categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('seo_id')->nullable()->constrained(table: 'cms_seo_settings')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('template_id')->nullable()->constrained(table: 'cms_templates')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
