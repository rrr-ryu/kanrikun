<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function allProducts()
    {
        $products = $this->all();
        return $products;
    }

    public function findProduct($id)
    {
        $product = $this->findOrFail($id);
        return $product;
    }

    // 表示商品の取得
    public function searchProducts($search = null, $company = null)
    {
        if($search && $company){
            $products = $this->where('product_name', 'like', "%$search%")->where('company_id', $company)->get();
        }else if($search){
            $products = $this->where('product_name', 'like', "%$search%")->get();
        }else if($company){
            $products = $this->where('company_id', $company)->get();
        }else{
            $products = $this->all();
        }

        foreach ($products as $product) {
            $product['company'] = $product->company;
        }

        return $products;

    }

    // プロダクト作成
    public function createProduct($request)
    {
        // 画像保存処理
        if($file = $request->image){
            $fileName = uniqid(rand().'_');
            $extension = $file->extension(); 
            $fileNameToStore = $fileName. '.' . $extension;
            Storage::putFileAs('public/product/', $file, $fileNameToStore);
        }else{
            $fileNameToStore = '';
        }

        // 商品保存処理 
        $product = $this->create([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $fileNameToStore
        ]);
    }

    // プロダクト更新
    public function updateProduct($id, $request)
    {
        $product = $this::findOrFail($id);
    
        // 画像保存処理
        if ($file = $request->image) {
            $fileName = uniqid(rand().'_');
            $extension = $file->extension(); 
            $fileNameToStore = $fileName . '.' . $extension;
            Storage::putFileAs('public/product/', $file, $fileNameToStore);
            $product->img_path = $fileNameToStore;
        }
        
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();
    
        return $product;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}