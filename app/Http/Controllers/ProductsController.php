<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['string', 'max:255', 'nullable'],
            'company_id' => ['integer', 'nullable']
        ]);

        $search = $request->search;
        $company = $request->company_id;
        
        // 表示商品の取得
        $product = new Product();
        $products = $product->searchProducts($search, $company);

        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        // Companyセレクト用
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

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

        $product = new Product();
        $product->createProduct($request);

        return redirect()
        ->route('products.create');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

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

        $product = (new Product())->updateProduct($id, $request);

        return redirect()
        ->route('products.edit',['product' => $product->id]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
        ->route('products.index');
    }
}
