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
        Schema::table('travels', function (Blueprint $table) {
            // Idadagdag natin yung mga nawawalang columns base sa modern form natin
            if (!Schema::hasColumn('travels', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('travels', 'category')) {
                $table->string('category')->after('name');
            }
            if (!Schema::hasColumn('travels', 'sub_category')) {
                $table->string('sub_category')->nullable()->after('category');
            }
            if (!Schema::hasColumn('travels', 'image_url')) {
                $table->string('image_url')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travels', function (Blueprint $table) {
            $table->dropColumn(['name', 'category', 'sub_category', 'image_url']);
        });
    }
};