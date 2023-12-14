<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

use App\Models\ExchangeRate;

class ShareProps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rates = ExchangeRate::whereIn('currency', ['BTC', 'USD', 'ETH', 'DOGE', 'LTC', 'USDT'])->get()->map(function ($rate) {
            return [
                'iconTag' => $rate->currency,
                'text' => $rate->currency,
                'value' => 1 * $rate->value,
            ];
        });

        Inertia::share([
            'rates' => $rates
        ]);

        return $next($request);
    }
}
