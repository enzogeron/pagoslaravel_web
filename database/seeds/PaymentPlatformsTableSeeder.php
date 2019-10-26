<?php

use App\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   		PaymentPlatform::create([
   			'name' => 'Paypal',
   			'image' => 'paypal.jpg'
   		]);

   		PaymentPlatform::create([
   			'name' => 'Stripe',
   			'image' => 'stripe.jpg'
   		]);

   		PaymentPlatform::create([
   			'name' => 'MercadoPago',
   			'image' => 'mercadopago.jpg'
   		]);
    }
}
