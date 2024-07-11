<?php

namespace App\Models;
use App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $with = ['countries'];

    use HasFactory;
    protected $fillable = [
        "status",
        "bydefault",
        "currency_name",
        "currency_symbol",
        "currency_code",
        "currency_rate",
        "language_code",
        "country_id",
    ];

    public function countries()
    {

        return $this->belongsTo(Country::class,'country_id');
    }

}
