<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Company;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全件取得
        $products = Product::all();
        // Companyセレクト用
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Companyセレクト用
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション設定
        $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'comment' => ['string', 'max:1024', 'nullable'],
            'image' => ['file', 'mimes:jpeg,png,jpg,bmb'],
        ]);

        // 画像保存処理
        if($file = $request->image){
            $fileName = uniqid(rand().'_');
            $extension = $file->extension(); 
            $fileNameToStore = $fileName. '.' . $extension;
            Storage::putFileAs('public/product/', $file, $fileNameToStore);
        }else{
            // 選択されていなければサンプルを表示する
            $fileNameToStore = 'sample5.jpg';
        }

        // 商品保存処理 
        Product::create([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $fileNameToStore
        ]);

        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'comment' => ['string', 'max:1024', 'nullable'],
            'image' => ['file', 'mimes:jpeg,png,jpg,bmb'],
        ]);

        $product = Product::findOrFail($id);

        // 画像保存処理
        if($file = $request->image){
            $fileName = uniqid(rand().'_');
            $extension = $file->extension(); 
            $fileNameToStore = $fileName. '.' . $extension;
            Storage::putFileAs('public/product/', $file, $fileNameToStore);
            $product->img_path = $fileNameToStore;
        }
        
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

        return redirect()->route('products.edit',['product' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
