$(document).ready(function() {
    const searchForm = $('#searchForm');
    const select = $('#sort');
    const noResultMsg = $('<p>検索結果が見つかりませんでした</p>');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
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
                        const tr = '<tr>' + 
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
                                        '<a class="btn btn-danger" href="#" data-id="' + product.id + '" onclick="deletePost(this)">削除</a>' +
                                    '</form></td>' +
                                 '</tr>';
                        tbody.append(tr);
                    });
                }
            }
        });
    });
    select.change(function() {
        $.ajax({
            type: "POST",
            url: "products/sort",
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
                        const tr = '<tr>' + 
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
                                        '<a class="btn btn-danger" href="#" data-id="' + product.id + '" onclick="deletePost(this)">削除</a>' +
                                    '</form></td>' +
                                 '</tr>';
                        tbody.append(tr);
                    });
                }
            }
        });
    })
});
