@extends('layouts.app')

@section('content')

<div class="container">
  商品情報一覧画面
    <div class="row">
        <div class="text-center flex-row"><button type="button" onclick="location.href='{{ route('products.create') }}'" class="btn btn-primary m-2">新規商品登録</button></div>
    </div>
    <form action="">
        <input type="text">
        <select name="company_id" id="company_id">
            <option value="">メーカー名</option>
            @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
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
                      <td>{{ $product->company->company_name }}</td>
                      <td><button onclick="location.href='{{route('products.show',['product' => $product->id])}}'">詳細</button></td>
                      <td><button onclick="location.href='{{}}'">削除</button></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
    </div>
</div>
@endsection