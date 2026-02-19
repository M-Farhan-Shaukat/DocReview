<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('general_document_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('cascade');
            $table->string('unique_id')->nullable();
            $table->string('original_name');
            $table->string('file_path');
            $table->integer('file_size')->default(0);
            $table->string('mime_type')->nullable();
            $table->string('document_type')->nullable();
            $table->enum('status', [
                'pending',
                'under_review',
                'approved',
                'rejected',
                'verified',
                'completed'
            ])->default('pending');
            $table->text('notes')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
};
