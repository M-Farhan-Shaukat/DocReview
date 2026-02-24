<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('final_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('district')->nullable();
            $table->string('registration_no');
            $table->string('security_code');
            $table->string('name');
            $table->string('cnic');
            $table->string('guardian_name'); // S/O, D/O, W/O full text
            $table->text('current_mailing_address');
            $table->text('permanent_mailing_address');
            $table->string('occupation');
            $table->string('email');
            $table->string('official_contact_number');
            $table->string('mobile_number');
            $table->string('payment_method')->nullable();
            $table->string('amount_in_words');
            $table->date('payment_date');
            $table->decimal('total_amount', 12, 2);
            $table->string('cnic_copy')->nullable();
            $table->string('deposit_copy')->nullable();
            $table->string('booked_by');
            $table->date('booking_date');
            $table->string('applicant_signature')->nullable();
            $table->string('application_no')->nullable();
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_forms');
    }
};
