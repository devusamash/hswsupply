<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customerId';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'company',
        'address',
        'state',
        'country',
        'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customerId');
    }
}
