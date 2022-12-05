<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private function _setTransactionNumber($number)
    {
        $length = strlen($number);

        if ($length === 6) {
            return $number;
        } else if ($length === 5) {
            return '0'.$number;
        } else if ($length === 4) {
            return '00'.$number;
        } else if ($length === 3) {
            return '000'.$number;
        } else if ($length === 2) {
            return '0000'.$number;
        } else {
            return '00000'.$number;
        }
    }

    private function _setReportDate($date)
    {
        $month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $explodeDate = explode('-', $date);
     
        return $explodeDate[2] . ' ' . $month[ (int)$explodeDate[1]-1 ] . ' ' . $explodeDate[0];
    }

    public function index()
    {
        $transactionHeader = TransactionHeader::where([
            ['user_id', '=', auth()->user()->id],
            ['total', '=', 0],
        ])->first();

        $transactionDetail = null;

        if (!is_null($transactionHeader)) {
            $transactionDetail = TransactionDetail::with('product')->where([
                'doc_number' => $transactionHeader->doc_number
            ])->get()->toArray();
        }

        $total = 0;

        if (!is_null($transactionDetail)) {
            foreach ($transactionDetail as &$product) {
                $total += $product['sub_total'];
                $product['sub_total'] = "Rp " . number_format($product['sub_total'],2,',','.');
            }
        }

        $total = "Rp " . number_format($total,2,',','.');

        return view('cart', [
            'products' => $transactionDetail,
            'doc_number' => !is_null($transactionHeader) ? $transactionHeader['doc_number'] : 0,
            'total' => $total
        ]);
    }

    public function add_product(Request $request)
    {
        if ($request->ajax()) {
            
            $counterTransaction = (string) (TransactionHeader::get()->count() + 1);

            $transaction = TransactionHeader::with('detail')->where([
                ['user_id', '=', auth()->user()->id],
                ['total', '=', 0],
            ])->first();

            DB::beginTransaction();

            try {
                $product = Product::where([
                    'prod_code' => $request->id
                ])->first();

                $discount = $product->discount != 0 ? ($product->price*$product->discount)/100 : 0;
                $price = $product->price - $discount;

                if (is_null($product)) throw 'Product unkown';

                if (!is_null($transaction)) {
                    $transDetail = TransactionDetail::where([
                        'doc_code' => $transaction->doc_code,
                        'doc_number' => $transaction->doc_number,
                        'prod_code' => $request->id,
                    ])->first();

                    if (!is_null($transDetail)) {
                        $oldQuantity = $transDetail->quantity;
                        $transDetail->quantity = $oldQuantity + 1;
                        $transDetail->sub_total = $transDetail->price * $transDetail->quantity;
                        $transDetail->save();
                    } else {
                        $transDetail = new TransactionDetail();
                        $transDetail->doc_code = $transaction->doc_code;
                        $transDetail->doc_number = $transactionNumber = $this->_setTransactionNumber($transaction->doc_number);
                        $transDetail->prod_code = $product->prod_code;
                        $transDetail->price = $price;
                        $transDetail->quantity = 1;
                        $transDetail->unit = $product->unit;
                        $transDetail->sub_total = $price * 1;
                        $transDetail->currency = $product->currency;
                        $transDetail->save();
                    }

                } else {
                    $transactionCode = 'TRX';
                    $transactionNumber = $this->_setTransactionNumber($counterTransaction);

                    $transHeader = new TransactionHeader();
                    $transHeader->doc_code = $transactionCode;
                    $transHeader->doc_number = $transactionNumber;
                    $transHeader->user_id = auth()->user()->id;
                    $transHeader->total = 0;
                    $transHeader->date = null;
                    $transHeader->save();

                    $transDetail = new TransactionDetail();
                    $transDetail->doc_code = $transactionCode;
                    $transDetail->doc_number = $transactionNumber;
                    $transDetail->prod_code = $product->prod_code;
                    $transDetail->price = $price;
                    $transDetail->quantity = 1;
                    $transDetail->unit = $product->unit;
                    $transDetail->sub_total = $price * 1;
                    $transDetail->currency = $product->currency;
                    $transDetail->save();
                }
                
                DB::commit();
                return [
                    'status' => true,
                    'message' => 'Product successfully added to cart'
                ];
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        } else {
            return abort(403);
        }
    }

    public function checkout(Request $request)
    {
        if ($request->ajax()) {
            $docNumber = $this->_setTransactionNumber($request->id);
            $transactionHeader = TransactionHeader::where(['doc_number' => $docNumber])->first();
    
            $transactionDetail = null;
    
            if (!is_null($transactionHeader)) {
                $transactionDetail = TransactionDetail::select('sub_total')->where([
                    'doc_number' => $docNumber
                ])->get()->toArray();
            }
    
            $total = 0;
    
            if (!is_null($transactionDetail)) {
                foreach ($transactionDetail as &$product) {
                    $total += $product['sub_total'];
                }
            }

            $transactionHeader->total = $total;
            $transactionHeader->date = date('Y-m-d');
            $status = $transactionHeader->save();

            return $status;
        } else {
            return abort(403);
        }
    }

    public function print()
    {
        $transactions = TransactionHeader::with('author')->get()->toArray();

        if (!is_null($transactions)) {
            foreach ($transactions as &$transaction) {
                $detail = TransactionDetail::with('product')->select('prod_code','quantity')->where('doc_number',$this->_setTransactionNumber($transaction['doc_number']))->get()->toArray();
                
                $transaction['doc_number'] = $this->_setTransactionNumber($transaction['doc_number']);
                $transaction['total'] = "Rp " . number_format($transaction['total'],2,',','.');
                $transaction['date'] = $this->_setReportDate($transaction['date']);
                $transaction['detail'] = $detail;
            }
        }

        return view('print', [
            'transactions' => $transactions
        ]);
    }
}
