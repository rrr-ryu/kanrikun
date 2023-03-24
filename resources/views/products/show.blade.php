@extends('layouts.app')

@section('content')
<div class="container">
    商品情報詳細画面
    <div class="col justify-content-center">
        <div class="text-center mb-2">ID：{{ $product->id }}</div>
        <div class="w-25 m-auto mb-2 text-center">
            @if ($product->img_path)
            <img src="{{ asset('storage/product/' . $product->img_path) }}" class="img-thumbnail" alt="..."></td>
        @else
            <p>画像なし</p>
        @endif
        </div>
        <div class="text-center mb-2">商品名：{{ $product->product_name }}</div>
        <div class="text-center mb-2">メーカー名：{{ $product->company->company_name }}</div>
        <div class="text-center mb-2">価格：{{ $product->price }}</div>
        <div class="text-center mb-2">在庫数：{{ $product->stock }}</div>
        <div class="text-center">コメント：{{ $product->comment }}</div>
        <div class="text-center mb-2">
            <button type="button" onclick="location.href='{{ route('products.edit',['product' => $product->id])}}'">編集</button>
            <button type="button" onclick="location.href='{{ route('products.index')}}'">戻る</button>
        </div>
    </div>
</div>
@endsection
