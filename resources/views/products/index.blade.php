@extends('layouts.app')

@section('content')
<div class="container">
    商品情報一覧画面
    <div class="row">
        <div class="text-center flex-row"><button type="button" onclick="location.href='{{ route('products.create') }}'" class="btn btn-primary m-2">新規商品登録</button></div>
    </div>
    <div class="row justify-content-between">
        <div>
            <form id="searchForm" action="{{ route('products.search') }} " method="post">
                @csrf
                <div>
                    <label for="search">商品名</label>
                    <input type="text" id="search" name="search">
                </div>
                <div>
                    <label for="">価格</label>
                    <input type="text" id="searchPrice_min" name="searchPrice_min">
                    〜
                    <input type="text" id="searchPrice_max" name="searchPrice_max">
                </div>
                <div>
                    <label for="">在庫数</label>
                    <input type="text" id="searchStock_min" name="searchStock_min">
                    〜
                    <input type="text" id="searchStock_max" name="searchStock_max">
                </div>
                <div>
                    <label for="company_id">メーカー名</label>
                    <select name="company_id" id="company_id">
                        <option value="">未選択</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="searchButton">検索</button>
            </form>
        </div>
        <div>
            <form id="sortForm" action="{{ route('products.sort') }} " method="post">
                @csrf
                <label for="sort">ソート</label>
                <select name="sort">
                    <option id="sort_first" value="1">ID</option>
                    <option value="2">商品名</option>
                    <option value="3">価格</option>
                    <option value="4">在庫数</option>
                    <option value="5">メーカー名</option>
                </select>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-3">画像</th>
                    <th class="col-2">商品名</th>
                    <th class="col-1">価格</th>
                    <th class="col-1">在庫数</th>
                    <th class="col-2">メーカー名</th>
                    <th class="col-1"></th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody class="tableBody">
                @foreach ( $products as $product )
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->img_path)
                            <img src="{{ asset('storage/product/' . $product->img_path) }}" class="img-thumbnail" alt="..."></td>
                        @else
                            <p>画像なし</p>
                        @endif
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td><button class="btn btn-success" onclick="location.href='{{ route('products.show',['product' => $product->id]) }}'">詳細</button></td>
                    <td>
                        <form id="delete_{{$product->id}}" method="post" action="{{ route('products.destroy', ['product' => $product->id])}}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-danger" href="#" data-id="{{ $product->id }}" onclick="deletePost(this)">削除</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
