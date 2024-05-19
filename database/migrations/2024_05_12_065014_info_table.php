<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Executed: php artisan migrate
     */
    public function up(): void
    {
        if (!Schema::hasTable('info_tbl')) {
            Schema::create("info_tbl", function (Blueprint $table) {
                $table->id()->primary();
                $table->string("name")->nullable();
                $table->string("email")->unique();
                $table->string('password');
                $table->string("imageName")->nullable();
                $table->timestamp("created_at")->useCurrent();
            });

            echo "The table 'info_tbl' has been created.";
        } else {
            echo "The table 'info_tbl' already exists.";
        }
    }

    /**
     * Reverse the migrations.
     * Executed :
     * php artisan migrate:rollback
     */
    public function down(): void
    {
        //
        schema::dropIfExists("info_tbl");
    }
};
