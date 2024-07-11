<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $table = 'product_sub_categories';
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'name', 'detail',
        'category_id', 'detail',
        'description', 'detail'
    ];


    public function product_category(){
      return $this->hasOne(ProductCategory::class, 'id', 'category_id');
   }
}