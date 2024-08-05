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
        Schema::table('cms_designs', function (Blueprint $table) {
            $table->string('type')->default('module')->comment('Loại của bản thiết kế. Có thể là category types(collection, asset, ...), module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms_designs', function (Blueprint $table) {
            Schema::dropColumns('cms_designs', 'type');
        });
    }
};
