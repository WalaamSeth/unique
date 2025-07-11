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
        Schema::create('permission_boxes', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id();
            $table->string('name')->nullable();

            $table->float('view_resource')->default(0);
            $table->float('read_resource')->default(0);
            $table->float('create_resource')->default(0);
            $table->float('view_user')->default(0);
            $table->float('read_user')->default(0);
            $table->float('create_user')->default(0);
            $table->float('view_product')->default(0);
            $table->float('read_product')->default(0);
            $table->float('create_product')->default(0);
            $table->float('view_article')->default(0);
            $table->float('read_article')->default(0);
            $table->float('create_article')->default(0);
            $table->float('is_admin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_boxes');
    }
};
