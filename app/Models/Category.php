<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'photo',
        'is_parent',
        'status',
        'parent_id'
    ];

    public function productsMR()
    {
        return $this->hasmany(Product::class,'cat_id','id');
    }
}
