<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Country;
use App\Models\CountryShippingMethod;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
    }

    public function products()
    {
        $products = Product::all();

        return view('pages.admin.product.list', [
            'products' => $products
        ]);
    }

    public function createProduct()
    {
        return view('pages.admin.product.create');
    }

    public function createProductPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'price' => 'required|numeric'
            ],
            [
                'price.numeric' => 'Az ár mező csak számokat tartalmazhat!'
            ]
        );

        Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->route('admin.products')->with(['success' => 'Termék sikeresen létrehozva!']);
    }

    public function editProduct(int $id)
    {
        return view('pages.admin.product.edit', [
            'product' => Product::find($id)
        ]);
    }

    public function editProductPost(int $id, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'price' => 'required|numeric'
            ],
            [
                'price.numeric' => 'Az ár mező csak számokat tartalmazhat!'
            ]
        );

        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('admin.products')->with(['success' => 'Termék sikeresen módosítva!']);
    }

    public function deleteProduct(int $id)
    {
        if (!OrderProduct::where('product_id', $id)->get()->isEmpty()) {
            return redirect()->route('admin.products')->withErrors(['Termék már szerepel rendelésben, így nem távolítható el!']);
        }

        Product::find($id)->delete();
        return redirect()->route('admin.products')->with(['success' => 'Termék sikeresen eltávolítva!']);
    }

    public function countries()
    {
        $countries = Country::all();
        return view('pages.admin.country.list', [
            'countries' => $countries
        ]);
    }

    public function createCountry()
    {
        return view('pages.admin.country.create', [
            'shippingMethods' => ShippingMethod::all()
        ]);
    }

    public function createCountryPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:country,name',
            ],
            [
                'name.unique' => 'Ez az ország már létezik!'
            ]
        );

        $country = Country::create([
            'name' => $request->name
        ]);

        if ($request->has('shipping_method')) {
            foreach ($request->shipping_method as $shippingMethod) {
                CountryShippingMethod::create([
                    'country_id' => $country->id,
                    'shipping_method_id' => $shippingMethod
                ]);
            }
        }

        return redirect()->route('admin.countries')->with(['success' => 'Ország sikeresen létrehozva!']);
    }

    public function editCountry(int $id)
    {
        $countryShippingMethods = CountryShippingMethod::where('country_id', $id)->pluck('shipping_method_id')->toArray();

        return view('pages.admin.country.edit', [
            'country' => Country::find($id),
            'countryShippingMethods' => $countryShippingMethods,
            'shippingMethods' => ShippingMethod::all()
        ]);
    }

    public function editCountryPost(int $id, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        $country = Country::find($id);

        $country->name = $request->name;

        $country->save();

        CountryShippingMethod::where('country_id', $id)->delete();

        if ($request->has('shipping_method')) {
            foreach ($request->shipping_method as $shippingMethod) {
                CountryShippingMethod::create([
                    'country_id' => $country->id,
                    'shipping_method_id' => $shippingMethod
                ]);
            }
        }

        return redirect()->route('admin.countries')->with(['success' => 'Ország sikeresen módosítva!']);
    }

    public function deleteCountry(int $id)
    {
        if (!Order::where('country', $id)->get()->isEmpty()) {
            return redirect()->route('admin.countries')->withErrors(['Az ország szerepel már rendelésben, ezért nem távolítható el!']);
        }

        CountryShippingMethod::where('country_id', $id)->delete();
        Country::find($id)->delete();
        return redirect()->route('admin.countries')->with(['success' => 'Ország sikeresen eltávolítva!']);
    }

    public function shippingMethods()
    {
        $shippingMethods = ShippingMethod::all();
        return view('pages.admin.shippingMethod.list', [
            'shippingMethods' => $shippingMethods
        ]);
    }

    public function createShippingMethod()
    {
        return view('pages.admin.shippingMethod.create');
    }

    public function createShippingMethodPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:shipping_method,name',
            ],
            [
                'name.unique' => 'Ez a szállítási mód már létezik!'
            ]
        );

        ShippingMethod::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.shippingMethods')->with(['success' => 'Szállítási mód sikeresen létrehozva!']);
    }

    public function editShippingMethod(int $id)
    {
        return view('pages.admin.shippingMethod.edit', [
            'shippingMethod' => ShippingMethod::find($id)
        ]);
    }

    public function editShippingMethodPost(int $id, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        $shippingMethod = ShippingMethod::find($id);

        $shippingMethod->name = $request->name;

        $shippingMethod->save();

        return redirect()->route('admin.shippingMethods')->with(['success' => 'Szállítási mód sikeresen módosítva!']);
    }

    public function deleteShippingMethod(int $id)
    {
        if (!Order::where('shipping_method', $id)->get()->isEmpty()) {
            return redirect()->route('admin.shippingMethods')->withErrors(['A szállítási mód szerepel már rendelésben, ezért nem távolítható el!']);
        }

        CountryShippingMethod::where('shipping_method_id', $id)->delete();
        ShippingMethod::find($id)->delete();
        return redirect()->route('admin.shippingMethods')->with(['success' => 'Szállítási mód sikeresen eltávolítva!']);
    }

    public function orders()
    {
        $orders = Order::with(['countryRelation', 'shippingMethod'])->get();

        return view('pages.admin.order.list', [
            'orders' => $orders
        ]);
    }

    public function exportToXLSX()
    {
        $rows = $this->getXlsxContent();

        require_once __DIR__ . '/../../Components/xlsx-writer-master/xlsxwriter.class.php';
        $storagePath = __DIR__ . '/../../temp/xlsx/';
        $filename = 'Rendeles_lista_' . date('Y-m-d_H-i-s') . '.xlsx';
        $sheetname = 'Rendelés lista';

        header('Content-disposition: attachment; filename="' . \XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $writer = new \XLSXWriter();
        $writer->setAuthor('Aktivdigital');

        $styles = [
            'wrap_text' => true
        ];

        $writer->writeSheetHeader($sheetname, ['Rendelési lista' => 'string'], ['widths' => [
            10, 25, 25, 25, 25, 25, 25, 25, 25, 25
        ]]);
        $writer->markMergedCell($sheetname, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 13);

        foreach ($rows as $key => $row) {
            if ($key > 0) {

                $styles = [
                    'font-size' => 10,
                    'border' => 'left,right,top,bottom',
                    'font' => 'Arial',
                    'border-style' => 'thin',
                    'border-color' => '#000000',
                    'valign' => 'center',
                    'halign' => 'right',
                    'wrap_text' => true,
                    'padding' => 5
                ];

                $writer->writeSheetRow($sheetname, $row, $styles);
            } else {
                $writer->writeSheetRow($sheetname, $row, array_merge($styles, [
                    'font-style' => 'bold'
                ]));
            }
        }

        $writer->writeToStdOut();
    }

    private function getXlsxContent()
    {
        $orders = Order::with(['countryRelation', 'shippingMethod', 'orderProduct.product'])->get();


        $csvArray = [];

        if (!$orders->isEmpty()) {

            $csvArray[0] = [
                '#', 'Név', 'Nem', 'E-mail', 'Telefon', 'Kor', 'Ország', 'Szállítási mód', 'Termékek', 'Beérkezett'
            ];

            foreach ($orders as $i => $order) {

                $products = '';

                foreach ($order->orderProduct as $orderProduct) {
                    $products .= $orderProduct->product->name . ', ';
                }

                $products = trim($products, ', ');

                $csvArray[$i + 1] = [
                    $order->id,
                    $order->name,
                    ($order->sex == 1) ? 'Férfi' : 'Nő',
                    $order->email,
                    $order->phone,
                    $order->age,
                    $order->countryRelation->country,
                    $order->shippingMethod->name,
                    $products,
                    $order->created_at->format('Y-m-d H:i:s')
                ];
            }
        }

        return $csvArray;
    }
}
