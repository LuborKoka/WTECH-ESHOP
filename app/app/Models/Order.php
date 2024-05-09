<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_address',
        'zipcode',
        'city',
        'shipping_method',
        'payment_method',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
