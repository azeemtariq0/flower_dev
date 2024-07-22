<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Order extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
              'date',
              'time',
              'year',
              'first_name',
              'last_name',
              'name',
              'phone_no',
              'email',
              'city_name',
              'address',
              'massage',
              'items',
              'TotalAmount',
              'created_date',
              'Status'    
    ];

    
     public function order_detail(){
      return $this->hasMany(OrderDetail::class, 'OrderId', 'id');
   }

}