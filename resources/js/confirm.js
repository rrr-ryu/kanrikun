window.deletePost = function(e){
    if (confirm('本当に削除してもいいですか?'))
        { 
            document.getElementById('delete_' + e.dataset.id).submit(); 
        }
}
