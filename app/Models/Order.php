<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Uuids;

    public $fillable = [
        'name', 'index', 'address', 'email', 'phone', 'color', 'amount', 'promo_code_id'
    ];

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
