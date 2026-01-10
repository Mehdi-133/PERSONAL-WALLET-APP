<?php

namespace App\Traits;

trait MoneyFormatterTrait
{
    public function formatMoney($amount, $currency = '$'): string
    {
        return $currency . number_format($amount, 2);
    }
    
    public function formatMoneyWithColor($amount, $currency = '$'): array
    {
        $formatted = $this->formatMoney($amount, $currency);
        $color = $amount >= 0 ? 'text-green-600' : 'text-red-600';
        
        return [
            'formatted' => $formatted,
            'color' => $color
        ];
    }
}
