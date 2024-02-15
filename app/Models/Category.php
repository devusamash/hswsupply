<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'categoryId';

    protected $fillable = [
        'categoryId',
        'categoryName',
        'categoryDescription',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
