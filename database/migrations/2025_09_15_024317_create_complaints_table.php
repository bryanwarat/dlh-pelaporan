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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('name');
            $table->string('nik')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('email')->nullable();
            $table->text('complaint');
            $table->text('complaint_link')->nullable();
            $table->text('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->integer('status');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
