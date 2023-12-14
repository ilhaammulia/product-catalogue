<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get("https://api.coinbase.com/v2/exchange-rates?currency=BTC")->object();
        foreach ($response->data->rates as $currency => $value) {
            ExchangeRate::updateOrCreate(
                ['currency' => $currency, 'origin_currency' => $response->data->currency],
                ['value' => $value]
            );
        }
    }
}
