<?php

namespace App\Http\Controllers;

use App\Currency;
use App\PaymentPlatform;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $paymentPlatforms = PaymentPlatform::all();
        $currencies = Currency::all();
        return view('home')->with([
            'currencies' => $currencies,
            'paymentPlatforms' => $paymentPlatforms
        ]);
    }
}
