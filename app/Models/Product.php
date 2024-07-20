<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'product_sub_category_id',
        'product_code',
        'product_name',
        'sell_price',
        'color_id',
        'description',
    ];

    
    public function product_detail(){
      return $this->hasMany(ProductDetail::class, 'product_id', 'id');
   }

  

}