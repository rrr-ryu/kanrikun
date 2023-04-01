$(document).ready(function() {
    const searchForm = $('#searchForm');
    const noResultMsg = $('<p>検索結果が見つかりませんでした</p>');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const sortFirst = $('#sort_first');
    searchForm.on('submit', function(e) {
        e.preventDefault();
        // すでに表示されているメッセージを削除
        if (noResultMsg.is(':visible')) {
            noResultMsg.remove();
        }
        $.ajax({
            type: "POST",
            url: "products/search",
            data: $(this).serialize(),
            success: function(response) {
                const products = response;
                const tbody = $('.tableBody');
                tbody.empty();
                if (products.length === 0) {
                    searchForm.append(noResultMsg);
                } else {
                    $.each(products, function(i, product) {
                        const img_path = 'storage/product/' + product.img_path;
                        const tr = '<tr id="product_' + product.id + '">' + 
                                    '<td>' + product.id + '</td>' +
                                    '<td><img src="' + img_path + '" class="img-thumbnail" alt="..."></td>' +
                                    '<td>' + product.product_name + '</td>' +
                                    '<td>' + product.price + '</td>' +
                                    '<td>' + product.stock + '</td>' +
                                    '<td>' + product.company.company_name + '</td>' +
                                    '<td><button class="btn btn-success" onclick="location.href=\'products/' + product.id + '\'">詳細</button></td>' +
                                    '<td><form id="delete_' + product.id + '" method="post" action="products/' + product.id + '">' +
                                        '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                                        '<input type="hidden" name="_method" value="delete">' +
                                        '<a class="btn btn-danger delete-btn" href="#" data-id="' + product.id + '">削除</a>' +
                                    '</form></td>' +
                                 '</tr>';
                        tbody.append(tr);
                    });
                }
                // 検索した時にソートをIDに戻す
                sortFirst.prop("selected", true);
            }
        });
        // 検索後入力した内容を消す
        searchForm.find(':text').val("");
    });
});
