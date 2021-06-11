$(".admin-remove-btn").on('click', function () {
    if(confirm('Are you sure?')){
        $('.admin-remove-form').submit();
    }
})

