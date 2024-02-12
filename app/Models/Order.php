<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'orderID';

    protected $fillable = [
        'orderId',
        'customerId',
        'orderDate',
        'orderTotal',
    ];
}
