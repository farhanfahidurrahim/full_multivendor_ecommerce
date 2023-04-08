<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','slug','summary','description','photo','stock','price','offer_price','discount','size','conditions','status','brand_id','cat_id','added_by','user_id','is_featured',
    ];

    public function relatedProductMR()
    {
        return $this->hasMany(Product::class,'cat_id','cat_id')->where('status','active')->limit(10);
    }

    public static function getProductByCart($id)
    {
        return self::where('id',$id)->get()->toArray();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_orders')->withPivot('quantity');
    }

}
