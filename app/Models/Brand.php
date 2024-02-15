<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brandId';

    protected $fillable = [
        'brandId',
        'brandName',
        'brandDescription',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
