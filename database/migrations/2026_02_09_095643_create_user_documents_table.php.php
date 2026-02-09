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
            $table->foreignId('attachment_id')->nullable()->constrained()->onDelete('set null');

            // Document details
            $table->string('original_name');
            $table->string('file_path');
            $table->integer('file_size')->default(0);
            $table->string('mime_type')->nullable();
            $table->string('document_type')->nullable(); // agreement, payment_slip, supporting_doc

            // Status tracking
            $table->enum('status', [
                'pending',      // Just uploaded
                'under_review', // Being reviewed by staff
                'approved',     // Approved by staff
                'rejected',     // Rejected
                'verified',     // Payment verified by manager
                'completed'     // All steps completed
            ])->default('pending');

            // Additional info
            $table->text('notes')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
};
