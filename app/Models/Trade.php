<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'company_symbol',
        'buy_price',
        'sell_price',
        'amount_bought',
    ];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
