<?php

namespace Crater\Http\Controllers\V1\General;

use Crater\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crater\Models\Currency;
use Crater\Models\Country;
use Auth;
use Crater\Models\CompanySetting;
use Crater\Models\CustomField;

class BootstrapController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $default_language = $user->getSettings(['language'])['language'];

        $settings = [
            'moment_date_format',
            'carbon_date_format',
            'fiscal_year',
            'time_zone',
            'currency'
        ];

        $settings = CompanySetting::getSettings($settings, $user->company_id);

        $default_currency = Currency::findOrFail($settings['currency']);

        return response()->json([
            'user' => $user,
            'company' => $user->company,
            // 'currencies' => Currency::all(),
            // 'countries' => Country::all(),
            'currencies' => Currency::where('id', 29)->get(),
            'countries' => Country::where('id', 142)->get(),
            'default_currency' => $default_currency,
            'default_language' => $default_language,
            'moment_date_format' => $settings['moment_date_format'],
            'carbon_date_format' => $settings['carbon_date_format'],
            'fiscal_year' => $settings['fiscal_year'],
            'time_zone' => $settings['time_zone']
        ]);
    }
}
