<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $transactionHeader = TransactionHeader::where([
            ['user_id', '=', auth()->user()->id],
            ['total', '=', 0]
        ])->first();

        $transactionDetail = null;

        if (!is_null($transactionHeader)) {
            $transactionDetail = TransactionDetail::where([
                'doc_number' => $transactionHeader->doc_number
            ])->get()->toArray();
        }

        $products = Product::get()->toArray();

        foreach ($products as &$product) {
            $price = (int)$product['price'];
            $discount = (int)$product['discount'];
            $discountPrice = $price*$discount/100;

            if ($discount != 0) {
                $product['price_discount'] = "Rp " . number_format($price-$discountPrice,2,',','.');
            }

            $product['price'] = "Rp " . number_format($product['price'],2,',','.');
            $product['quantity'] = 0;

            if (!is_null($transactionDetail)) {
                $key = array_search($product['prod_code'], array_column($transactionDetail, 'prod_code'));

                $product['quantity'] = $key !== false ? $transactionDetail[$key]['quantity'] : 0;
            }
        }

        return view('product', [
            'products' => $products
        ]);
    }

    public function show($id)
    {

    }
}
