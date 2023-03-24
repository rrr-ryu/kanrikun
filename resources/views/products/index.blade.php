@extends('layouts.app')

@section('content')

<div class="container">
  商品情報一覧画面
    <div class="row">
        <div class="col-2 text-center"><a href="{{ route('products.create')}}">新規商品登録</a></div>
    </div>
    <form action="">
        <input type="text">
        <select name="" id="">
          <option value="">test</option>
        </select>
        <input type="button" value="検索">
    </form>
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
              <tbody>
                  @foreach ( $products as $product )
                  <tr>
                      <td>{{ $product->id }}</td>
                      <td><img src="{{asset('storage/product/' . $product->img_path)}}" class="img-thumbnail" alt="..."></td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>メーカー名</td>
                      <td><button onclick="">詳細</button></td>
                      <td><button onclick="location.href='{{}}'">削除</button></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
    </div>
</div>
@endsection