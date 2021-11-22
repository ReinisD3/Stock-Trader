<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'company_symbol',
        'buy_price',
        'sell_price',
        'amount_bought',
        'usd_invested',
        'profit',
        'profit_to_investment',
        'sold_at',
        'bought_at'
    ];

    public function scopeFilter($query, array $filters, int $userId)
    {
        $query->where('user_id', $userId);
        $query->when($filters['companyFilter'] ?? false, fn($query, $companyName) => $query
            ->where('company', $companyName));
        $query->when($filters['sortBy'] ?? false, fn($query, $sortBy) => $query
            ->orderBy($sortBy, $filters['sortDirection']));
        $query->orderBy('created_at', 'desc');
        $query->when($filters['transactionType'] ?? false, function($query, $transactionType) {
            if(strtolower($transactionType) === 'buy') {
                $query->where('profit', null);
            }
            if(strtolower($transactionType) === 'sell') {
                $query->whereNotNull('profit');
            }
        });

    }
}
