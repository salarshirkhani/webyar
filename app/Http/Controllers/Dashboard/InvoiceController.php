<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class InvoiceController extends Controller {
    function get(Invoice $invoice) {
        return view('dashboard.invoice', ['invoice' => $invoice]);
    }

    function pay(Request $request, Invoice $invoice) {
        $via = $request->input('gateway');
        if (!array_key_exists($via, config('payment.drivers')))
            abort(404);

        try {
            return \Payment
                ::via($via)
                ->amount((int)$invoice->amount)
                ->callbackUrl(route('dashboard.invoice.callback', compact('invoice')))
                ->purchase(
                    null,
                    function ($driver, $transactionId) use ($via, $invoice) {
                        $invoice->update([
                            'via' => $via,
                            'transaction_id' => $transactionId,
                            'status' => Invoice::STATE_PAYING,
                        ]);
                    }
                )
                ->pay()
                ->render();
        } catch (\Exception $ex) {
            $invoice->update([
                'status' => Invoice::STATE_UNPAID
            ]);
            return redirect()->back()->with('error', 'خطا در انتقال به درگاه. لطفا مجددا تلاش نمایید. متن خطا: ' . $ex->getMessage());
        }
    }

    function callback(Invoice $invoice) {
        if ($invoice->status == Invoice::STATE_PAID)
            abort(403);

        try {
            $receipt = \Payment
                ::amount($invoice->amount)
                ->transactionId($invoice->transaction_id)
                ->via($invoice->via)
                ->verify();

            $invoice->update([
                'reference_id' => $receipt->getReferenceId(),
                'status' => Invoice::STATE_PAID,
                'paid_at' => Carbon::now()
            ]);
            session()->flash('info', 'پرداخت با موفقیت انجام شد.');

        } catch (InvalidPaymentException $exception) {
            $invoice->update([
                'status' => Invoice::STATE_FAILED,
            ]);
            session()->flash('error', 'پرداخت ناموفق! در صورتی که پرداختی انجام داده اید به حساب شما باز خواهد گشت. متن خطا: ' . $exception->getMessage());
        }

        return redirect()->route('dashboard.invoice.get', compact('invoice'));
    }
}
