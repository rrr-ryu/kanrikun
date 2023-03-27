@extends('layouts.app')

@section('content')
<div class="container">
    商品情報編集画面
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('products.update',['product' => $product->id]) }}" enctype='multipart/form-data'>
            @csrf
            @method('put')
            <table>
                <div>
                    <tr>
                        <th><label for="">ID</label></th>
                        <td>{{ $product->id }}</td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="product_name">商品名</label></th>
                        <td><input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="company_id">メーカー</label></th>
                        <td>
                            <select name="company_id" id="company_id">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if ($company->id === $product->company_id)selected @endif>{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="price">価格</label></th>
                        <td><input type="text" name="price" id="price" value="{{ $product->price }}"></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="stock">在庫数</label></th>
                        <td><input type="text" name="stock" id="stock" value="{{ $product->stock }}"></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="comment">コメント</label></th>
                        <td><textarea name="comment" id="comment">{{ $product->comment }}</textarea></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="image">現在の画像</label></th>
                        <td><img src="{{ asset('storage/product/' . $product->img_path) }}" class="img-thumbnail w-50" alt="..."></td>
                    </tr>  
                </div>
                <div>
                    <tr>
                        <th><label for="image">変更する画像を選択して下さい</label></th>
                        <td><input type="file" name="image" id="image"></td>
                    </tr>  
                </div>
            </table>
            <div>
                <button type="button" onclick="location.href='{{ route('products.show',['product' => $product->id])}}'">戻る</button>
                <input type="submit" value="更新する">
            </div>
        </form>
    </div>
</div>
@endsection
