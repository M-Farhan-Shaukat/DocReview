<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalForm extends Model
{
    protected $fillable = [
        'user_id',
        'district',
        'registration_no',
        'security_code',
        'name',
        'cnic',
        'guardian_name',
        'current_mailing_address',
        'permanent_mailing_address',
        'occupation',
        'email',
        'official_contact_number',
        'mobile_number',
        'amount_in_words',
        'cnic_copy',
        'deposit_copy',
        'payment_date',
        'total_amount',
        'booked_by',
        'booking_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
