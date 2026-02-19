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
        Schema::create('general_documents', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('type', 100)->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('sort_order')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_documents');
    }
};
