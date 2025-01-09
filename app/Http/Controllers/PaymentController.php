<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(Request $request)
    {
        $user = Auth::user();
        $feeForRegister = $user->fee_for_register;
        $payPrice = $request->input('pay_price');
        $isOverpaid = filter_var($request->input('is_overpaid'), FILTER_VALIDATE_BOOLEAN);;

        if ($payPrice < $feeForRegister) {
            $amountUnderpaid = $feeForRegister - $payPrice;
            return redirect()->back()
                ->withErrors(['pay_price' => "You are still underpaid $amountUnderpaid coins."])->withInput();
        } elseif ($payPrice > $feeForRegister && !$isOverpaid) {
            $amountOverpaid = $payPrice - $feeForRegister;
            return redirect()->back()
                ->with('overpaid', $amountOverpaid)
                ->withInput();
        }

        // Process the payment
        // Add logic to mark payment as complete, update user status, etc.
        DB::statement("
            UPDATE users
            SET fee_for_register = 0,
            fund = fund - :pay_price
            WHERE id = :id
        ", ['id' => $user->id, 'pay_price' => $payPrice]);

        return redirect()->route('home')->with('success', 'Payment successful!');
    }

    public function topup(Request $request){
        DB::statement("
            UPDATE users
            SET fund = fund + 100
            WHERE id = :id
        ", ['id' => Auth::user()->id]);

        return redirect()->back();
    }

    public function index()
    {
        return view('payment');
    }
}
