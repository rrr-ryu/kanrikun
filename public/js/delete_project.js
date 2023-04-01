$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    const id = $(this).data('id');
    if (confirm('本当に削除してもいいですか?')){
        const url = 'products/' + id;
        const token = $('meta[name="csrf-token"]').attr('content');
        const data = {
            _method: 'DELETE',
            _token: token,
            _id: id,
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,

        });
        const tr = $('#product_' + id);
        tr.hide();
    }
});
