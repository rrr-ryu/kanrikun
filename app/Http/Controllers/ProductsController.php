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
        $products = (new Product())->searchProducts();
        $companies = (new Company())->allCompanies();

        session_start();
        $_SESSION['products'] = $products;


        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        // Companyセレクト用
        $companies = (new Company())->allCompanies();
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

        $product = (new Product())->createProduct($request);

        return redirect()
        ->route('products.create');
    }

    public function show($id)
    {
        $product = (new Product())->findProduct($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = (new Product())->findProduct($id);
        $companies = (new Company())->allCompanies();
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
        $product = (new Product())->findProduct($id)
        ->delete();

        return redirect()
        ->route('products.index');
    }

    public function search()
    {
        $search = $_POST["search"];
        $companyId = $_POST["company_id"];
        $minPrice = $_POST["searchPrice_min"];
        $maxPrice = $_POST["searchPrice_max"];
        $minStock = $_POST["searchStock_min"];
        $maxStock = $_POST["searchStock_max"];
        
        // 表示商品の取得
        $products = (new Product())
        ->searchProducts($minPrice, $maxPrice, $minStock, $maxStock, $search, $companyId);

        // セッションに配列を保存するコード
        session_start();
        $_SESSION['products'] = $products;

        return $products;
    }

    public function sort()
    {
        // セッションから配列を取得するコード
        session_start();
        $products = $_SESSION['products'];

        $sort_name = $_POST['sort'];

        switch ($sort_name) {
            case 1:
                $sort_key = 'id';
                break;
            case 2:
                $sort_key = 'product_name';
                break;
            case 3:
                $sort_key = 'price';
                break;
            case 4:
                $sort_key = 'stock';
                break;
            case 5:
                $sort_key = 'company_id';
                break;
            default:
                $sort_key = 'id';
                break;
        }

        $sortProducts = $products->sortByDesc($sort_key);
        return $sortProducts;
        
    }
}
