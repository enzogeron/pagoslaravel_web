<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaypalService;
use App\Resolvers\PaymentPlatformResolver;

class PaymentController extends Controller
{

	public function __construct(PaymentPlatformResolver $paymentPlatformResolver) {

        $this->middleware('auth');
        $this->paymentPlatformResolver = $paymentPlatformResolver;

    }


	public function pay(Request $request) {

		$rules = [
			'value' => ['required', 'numeric', 'min:5'],
			'currency' => ['required', 'exists:currencies,iso'],
			'payment_platform' => ['required', 'exists:payment_platforms,id']
		];

		$request->validate($rules);

		$paymentPlatform = $this->paymentPlatformResolver
			->resolveService($request->payment_platform);

		$paymentPlatform = resolve(PaypalService::class);

		session()->put('paymentPlatformId', $request->payment_platform);

		return $paymentPlatform->handlePayment($request);
	}

	public function approval() {

		if(session()->has('paymentPlatformId')) {
			$paymentPlatform = $this->paymentPlatformResolver
				->resolveService(session()->get('paymentPlatformId'));
			return $paymentPlatform->handleApproval();
		}


		return redirect()->route('home')->withErrors('No se puede obtener la plataforma de pago.');

	}

	public function cancelled() {
		return redirect()->route('home')->withErrors('Se cancelo el pago.');
	}

}
