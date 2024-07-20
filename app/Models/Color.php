<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = ['color_name','color_code','description','created_by','created_at'];


     
}