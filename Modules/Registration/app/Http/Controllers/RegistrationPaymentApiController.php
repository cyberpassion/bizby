<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationPayment;
use App\Http\Controllers\Controller;

class RegistrationPaymentApiController extends Controller
{
    public function pay($id)
    {
        return RegistrationPayment::create([
            'registration_id' => $id,
            'amount' => 500,
            'status' => 'paid',
            'gateway_ref' => uniqid('pay_')
        ]);
    }
}
