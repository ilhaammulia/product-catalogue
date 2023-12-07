<?php

namespace App\Console;

use App\Models\ExchangeRate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\Http;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // Update currency
        $schedule->call(function () {
            $response = Http::get("https://api.coinbase.com/v2/exchange-rates?currency=BTC")->object();
            foreach ($response->data->rates as $currency => $value) {
                ExchangeRate::updateOrCreate(
                    ['currency' => $currency, 'origin_currency' => $response->data->currency],
                    ['value' => $value]
                );
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
