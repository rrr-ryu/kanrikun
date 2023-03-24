@extends('layouts.app')

@section('content')

<div class="container">
  商品情報一覧画面
    <div class="row">
        <div class="text-center flex-row"><button type="button" onclick="location.href='{{ route('products.create') }}'" class="btn btn-primary m-2">新規商品登録</button></div>
    </div>
    <form action="{{ route('products.index') }} " method="get">
        <input type="text" name="search">
        <select name="company_id" id="company_id">
            <option value="">メーカー名</option>
            @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
        <input type="submit" value="検索">
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
                @if ($products->count() === 0)
                    <p>検索結果が見つかりませんでした</p>
                @else
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
                @endif
              </tbody>
          </table>
    </div>
</div>
@endsection