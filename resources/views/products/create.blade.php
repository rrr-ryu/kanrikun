@extends('layouts.app')

@section('content')
<div class="container">
    商品情報登録画面
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('products.store') }}" enctype='multipart/form-data'>
            @csrf
            <table>
                <div>
                    <tr>
                        <th><label for="product_name">商品名</label></th>
                        <td><input type="text" name="product_name" id="product_name" value=""></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="company_id">メーカー</label></th>
                        <td>
                            <select name="company_id" id="company_id">
                                <option value="1">アサヒ</option>
                            </select>
                        </td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="price">価格</label></th>
                        <td><input type="text" name="price" id="price" value=""></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="stock">在庫数</label></th>
                        <td><input type="text" name="stock" id="stock"></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="comment">コメント</label></th>
                        <td><textarea name="comment" id="comment" placeholder="コメントがあれば入力して下さい"></textarea></td>
                    </tr>
                </div>
                <div>
                    <tr>
                        <th><label for="image">画像</label></th>
                        <td><input type="file" name="image" id="image"></td>
                    </tr>  
                </div>
            </table>
            <div>
                <button type="button" onclick="location.href='{{ route('products.index')}}'">戻る</button>
                <input type="submit">
            </div>
        </form>
    </div>
</div>
@endsection