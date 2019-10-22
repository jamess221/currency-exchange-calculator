<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CurrencyRequest;
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
        $currencies = config('currency.currencies');

        return response()->json($currencies);
    }

    public function calculate(CurrencyRequest $request)
    {
        $url = str_replace('{currency}', $request->from, config('currency.base_url'));

        $data = simplexml_load_file($url);

        $exchangeObj = $data->xpath("//item[".config('currency.target_key')."='".$request->to."']")[0];

        $rate = (string) $exchangeObj->{config('currency.rate_key')};

        $converted = $request->value * $rate;

        $response = $request->value . ' ' . $request->from . ' = ' . $converted . ' ' . $request->to;

        return response()->json($response);
    }
}
