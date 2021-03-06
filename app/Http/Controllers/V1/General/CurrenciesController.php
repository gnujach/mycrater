<?php

namespace Crater\Http\Controllers\V1\General;

use Crater\Models\Currency;
use Crater\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $currencies = Currency::latest()->get();
        // $currencies = Currency::where('id', 1)->get();

        return response()->json([
            'currencies' => $currencies
        ]);
    }
}
