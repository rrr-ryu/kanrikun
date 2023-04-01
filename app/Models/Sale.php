<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
    ];

    public function createSale($id)
    {
        // 商品保存処理 
        $product = $this->create([
            'product_id' => $id,
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
