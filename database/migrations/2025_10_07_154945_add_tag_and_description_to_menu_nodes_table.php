<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menu_nodes', function (Blueprint $table) {
            $table->string('tag')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('menu_nodes', function (Blueprint $table) {
            $table->dropColumn(['tag', 'description']);
        });
    }
};