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
        Schema::create('category', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('title');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->tinyInteger('status')->default(0)->comment('0:active , 1:inactive');
            $table->tinyInteger('is_delete')->default(0)->comment('0:not delete , 1:delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
