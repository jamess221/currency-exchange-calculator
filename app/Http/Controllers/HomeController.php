<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function currencies()
    {
        // todo: replace with list fetched from external source
        $currencies = ['GBP', 'USD', 'EUR', 'AUD', 'CAD', 'JPY'];

        return response()->json($currencies);
    }

    public function calculate(Request $request)
    {
        $url = str_replace('{currency}', $request->from, config('currency.base_url'));

        $data = simplexml_load_file($url);

        $exchangeObj = $data->xpath("//item[targetCurrency='".$request->to."']")[0];

        $rate = (string) $exchangeObj->exchangeRate;

        $converted = $request->value * $rate;

        $response = $request->value . ' ' . $request->from . ' = ' . $converted . ' ' . $request->to;

        return response()->json($response);
    }
}
