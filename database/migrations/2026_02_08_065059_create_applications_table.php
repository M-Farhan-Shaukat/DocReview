<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Snapshot of user info
            $table->string('name');
            $table->string('email');
            $table->integer('age')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('cnic')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('postal_code')->nullable();
            $table->longText('rejection_reason')->nullable();

            $table->string('status')->default('draft'); // draft, pending, approved, rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
