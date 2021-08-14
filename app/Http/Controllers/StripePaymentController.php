<?php

namespace App\Http\Controllers;

use App\Http\Services\MailService;
use App\Http\Services\ProductService;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripePaymentController extends Controller
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
     * success response method.
     *
     * @return Application|Factory|View
     */
    public function purchase($id)
    {
        $service = Service::find($id);

        return view('stripe/stripe', ['service' => $service]);
    }

    /**
     * @param $id
     * @param Request $request
     * @param ProductService $productService
     * @param MailService $mailService
     * @return RedirectResponse
     */
    public function stripePost(
        $id,
        Request $request,
        ProductService $productService,
        MailService $mailService
    ): RedirectResponse
    {
        $service = Service::find($id);

        if ($service->price != $request->amount) {
            Session::flash('alert-class', 'Payment Failed!');
            return back();
        }

        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                "amount" => $request->amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment"
            ]);

            $productService->createUserService($service);
            $mailService->sendMail();

        } catch (\Exception $exception) {
            Session::flash('alert-class', 'Payment Failed!');
            return back();
        }

        Session::flash('success', 'Payment successful!');
        return redirect()->route('user_services');
    }
}
