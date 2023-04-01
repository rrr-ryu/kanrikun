$(document).ready(function() {
    const sortForm = $('#sortForm');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    sortForm.on('change', 'select', function() {
        $.ajax({
            type: "POST",
            url: "products/sort",
            data: $(this).serialize() + "&_token=" + csrfToken,
            success: function(response) {
                const products = response;
                const tbody = $('.tableBody');
                tbody.empty();
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
        });
    });
})