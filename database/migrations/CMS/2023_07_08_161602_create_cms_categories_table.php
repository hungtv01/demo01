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
        Schema::create('cms_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('desc')->nullable();
            $table->string('item_class')->nullable();
            $table->foreignId('category_type_id')->nullable()->constrained(table: 'cms_category_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cms_categories');
    }
};
