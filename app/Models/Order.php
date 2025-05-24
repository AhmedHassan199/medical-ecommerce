<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['full_name', 'phone_number', 'delivery_address', 'total_price'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
