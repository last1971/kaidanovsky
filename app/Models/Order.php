<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, Uuids;

    public $fillable = [
        'name', 'index', 'address', 'email', 'phone', 'color', 'amount', 'promo_code_id'
    ];

    public string $salt;

    public function __construct(array $attributes = [])
    {
        $this->salt = Str::random();
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    /**
     * @return string
     */
    public function getMerchantAttribute(): string
    {
        return env('MODUL_MERCHANT', 'ad25ef06-1824-413f-8ef1-c08115b9b979');
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute(): string
    {
        return 'Оплата за открытку';
    }

    /**
     * @return string
     */
    public function getTestingAttribute(): string
    {
        return  App::environment('production') ? 0 : 1;
    }

    public function getUnixTimestampAttribute(): int
    {
        return $this->updated_at->unix();
    }

}
