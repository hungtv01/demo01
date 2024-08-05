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
        Schema::create('cms_category_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->boolean('is_many')->default(false)->comment('Có thể tạo nhiều đối tượng Danh Mục từ Loại Danh Mục này');
            $table->boolean('is_list')->default(false)->comment('Có thể có danh sách các đối tượng con thuộc Danh Mục này');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_category_types');
    }
};
