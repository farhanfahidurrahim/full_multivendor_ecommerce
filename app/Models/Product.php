<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'photo',
        'stock',
        'price',
        'offer_price',
        'discount',
        'size',
        'conditions',
        'status',
        'brand_id',
        'cat_id',
        'sub_cat_id',
        'vendor_id',
        'brand_id',
        'cat_id',
        'sub_cat_id',
        'vendor_id',
    ];

    public function relatedProductMR()
    {
        return $this->hasMany(Product::class,'cat_id','cat_id')->where('status','active')->limit(10);
    }

    public static function getProductByCart($id)
    {
        return self::where('id',$id)->get()->toArray();
    }

}
