<?php

namespace App\Mail;

use App\Models\TradeTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellTrade extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private TradeTransaction $trade;


    public function __construct(TradeTransaction $trade)
    {

        $this->trade = $trade;
    }

    public function build()
    {
        return $this->subject('Sold Stock ')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->markdown('mail.sellTrade', [
                'companyName' => $this->trade->company,
                'stockAmount' => $this->trade->amount_bought,
                'stockPrice' => $this->trade->sell_price,
                'stockProfit' => $this->trade->profit
            ]);
    }
}
