<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function payment()
    {
        try {
            $gateway = Gateway::of('PayIR'); // $gateway = new Payir(app(), config('gateways.payir'));
            $gateway->callbackUrl(route('callback')); // You can change the callback

            // You can make it stateless.
            // in default mode it uses session to store and retrieve transaction id
            // (and other gateway specific or user provided (using $gateway->with) required parameters)
            // but in stateless mode it gets transaction id and other required parameters from callback url
            // Caution: you should use same stateless value in callback too
            $gateway->stateless();

            // You can get supported extra fields sample for each gateway and then set these fields with your desired values
            // (most gateways support `mobile` field)
            $supportedExtraFieldsSample = $gateway->getSupportedExtraFieldsSample();

            return compact('supportedExtraFieldsSample');

            // Then you should create a transaction to be processed by the gateway
            // Amount is in `Toman` by default, but you can set the currency in second argument as well. IRR (for `Riyal`)
            $transaction = new RequestTransaction(new Amount(12000)); // 12000 Toman
            $transaction->setExtra([
                'mobile' => '09124441122',
                'email'  => 'ali@gmail.com',
                'person' => 12345,
            ]);
            $transaction->setExtraField('description', 'توضیحات من');

            // if you added additional fields in your migration you can assign a value to it in the beginning like this
            $transaction['person_id'] = auth()->user()->id;

            $authorizedTransaction = $gateway->authorize($transaction);

            $transactionId = $authorizedTransaction->getId(); // شماره‌ی تراکنش در جدول پایگاه‌داده
            $orderId = $authorizedTransaction->getOrderId(); // شماره‌ی تراکنش اعلامی به درگاه
            $referenceId = $authorizedTransaction->getReferenceId(); // شناسه‌ی تراکنش در درگاه (در صورت وجود)
            $token = $authorizedTransaction->getToken(); // توکن درگاه (در صورت وجود)

            // در اینجا
            // شماره تراکنش(ها) را با توجه به نوع ساختار پایگاه‌داده‌ی خود
            // در جداول مورد نیاز و بسته به نیاز سیستم‌تان ذخیره کنید.

            // this object tells us how to redirect to gateway
            $redirectResponse = $authorizedTransaction->getRedirect();

            // if you're developing an Api just return it and handle redirect in your frontend
            // (this gives you redirect method [get or post], url and fields)
            // (you can use a code like `redirector.blade.php`)
            return $redirectResponse;

            // otherwise use this solution to redirect user to gateway with proper response
            return $redirectResponse->redirect(app());

        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function addCart(Product $product)
    {
        \Cart::add(array(
            'id' => $product->id, // inique row ID
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array()
        ));

        return redirect()->route('cart');
    }

    public function removeCart(Product $product)
    {
        \Cart::update($product->id, array(
            'quantity' => -1,
            'attributes' => array()
        ));

        return redirect()->route('cart');
    }


}
