<?php

namespace App\Models\Trade;

use App\Models\User;
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
        'amount_bought',
        'usd_invested',
        'profit',
        'current_price',
        'profit_to_investment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters, int $userId)
    {

        $query->where('user_id', $userId);
        $query->when($filters['companyToFilter'] ?? false, fn($query, $companyName) => $query
            ->where('company', $companyName));

    }
}
