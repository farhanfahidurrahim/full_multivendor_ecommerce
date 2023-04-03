<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'order_number',
        'product_id',
        'sub_total',
        'total_amount',
        'coupon',
        'delivery_charge',
        'quantity',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'Shipping_phone',
        'Shipping_address',
        'shipping_city',
        'Shipping_state',
        'shipping_country',
    ];
}
