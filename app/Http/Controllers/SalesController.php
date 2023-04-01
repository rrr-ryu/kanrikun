<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SalesController extends Controller
{
    public function store(Request $request)
    {
        // リクエストからプロダクトIDを取得する
        $productId = $request->product_id;
        $product = (new Product())->findProduct($productId);

        // 購入数を取得する
        $quantity = $request->quantity;

        (new Sale())->createSale($productId);

        try {
            // 在庫数から購入数を減算する
            $product->saleProduct($quantity);

            $sumPrice = $product->price * $quantity;
            $result = [
                'result' => true,
                'product_name' => $product->product_name,
                'company_name' => $product->company->company_name,
                'price' => $product->price,
                'sumPrice' => $sumPrice,
                'stock' => $product->stock
            ];

        } catch (\Exception $e) {
            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->resConversionJson($result);
    }
    
    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
