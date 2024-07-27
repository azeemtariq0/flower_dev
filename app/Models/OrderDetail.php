<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class OrderDetail extends Model
{
    use HasFactory;
  
  protected $table = 'order_detail';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
                  'OrderId',
                  'year',
                  'ItemId' ,
                  'ItemQty',
                  'Status'
    ];

  public function product(){
    return $this->hasOne(Product::class, 'id', 'ItemId');
  }
    
    

}