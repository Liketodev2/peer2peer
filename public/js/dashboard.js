$(".admin-remove-btn").on('click', function () {
    if(confirm('Are you sure?')){
        $(this).next().submit();
    }
})

