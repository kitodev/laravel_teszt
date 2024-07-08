<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Country;
use App\Models\CountryShippingMethod;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $products = Product::all();
        $countries = Country::all();

        return view('pages.home.index', [
            'products' => $products,
            'countries' => $countries
        ]);
    }

    public function homePost(Request $request)
    {
        $this->validate($request, [
                'products' => 'required',
                'name' => 'required|regex:/^([^0-9]*)$/',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9]*)$/',
                'sex' => 'required',
                'country' => 'required',
                'shippingMethod' => 'required',
                'captcha' => 'required|captcha'
            ],
            [
                'products.required' => 'Legalább egy termék kiválasztása kötelező!',
                'name.required' => 'Teljes név kitöltése kötelező!',
                'name.regex' => 'A Teljes név nem tartalmazhat számokat!',
                'email.required' => 'Email cím kitöltése kötelező!',
                'email.email' => 'Nem megfelelő e-mail formátum!',
                'phone.required' => 'Telefonszám kitöltése kötelező!',
                'phone.regex' => 'Nem megfelelő telefonszám formátum!',
                'sex.required' => 'Nem kiválasztása kötelező!',
                'country.required' => 'Ország kiválasztása kötelező!',
                'shippingMethod.required' => 'Nem adott meg szállítási módot!',
                'captcha.required' => 'Captcha kitöltése kötelező!',
                'captcha.captcha' => 'Nem megfelelő Captcha!',
            ]
        );

        $order = Order::create(
            [
                'name' => $request->name,
                'sex' => $request->sex,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'country' => $request->country,
                'shipping_method' => $request->shippingMethod
            ]
        );

        foreach($request->products as $product){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product
            ]);
        }

        return redirect()->route('home')->with(['success' => 'Sikeres regisztráció!']);
    }

    public function getShippingMethodsByCountry($id)
    {
        $shippingMethods = ShippingMethod::whereHas('countryShippingMethod', function($query) use ($id){
            $query->where('country_id', $id);
        })->get();

        return view('pages.home.shippingMethods', [
            'shippingMethods' => $shippingMethods,
        ]);
    }
}
