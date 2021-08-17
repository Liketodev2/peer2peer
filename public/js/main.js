$( document ).ready(function() {
 $('.nav-bottom .nav-item').click(function () {
     $('.nav-bottom .nav-item').removeClass("active");
    $(this).addClass("active");
 })
});
$(document).ready(function() {

    $('.send-message-btn').click(function () {

        let message = $('#message').val();
        let conversation_id = $('#conversation_id').val();

        $.ajax({
            type: "POST",
            url: "/message",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                message : message,
                conversation_id : conversation_id
            },
            success: function(data){
                $('.chat-content').append(data.html);
                $('#message').val('');
            }
        });
    });


    $('.remove-chat-message').click(function () {

        let id = $(this).data('id');
        let root = $(this);

        $.ajax({
            type: "POST",
            url: "/messages/delete",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id : id,
            },
            success: function(data){
                if(data.result){
                    $(root).parent().parent().parent().fadeOut();
                }
            }
        });
    });

    $(".fa-caret-down").click(function () {
        $(this).toggleClass("rotate");
    });

    $('.log-in-submit').on('click', function(){
        localStorage.removeItem('login_type');
        localStorage.setItem('login_type','login');
    });

    $('.sign-up-submit').on('click', function(){
        localStorage.removeItem('login_type');
        localStorage.setItem('login_type','register');
    });

    $('.forgot-btn').on('click', function(){
        localStorage.removeItem('login_type');
        localStorage.setItem('login_type','forgot');
    });

    $('.res-btn').on('click', function(){
        localStorage.removeItem('login_type');
        localStorage.setItem('login_type','reset');
    });

    $('.remove-auth-validation').on('click', function () {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');
    });

    $(document).on('click','.like', function(){

        $('.like-trigger').not($(this)).removeClass('active');
        $(this).toggleClass('active');

        let feed_id = $(this).data('feed');
        let is_like = $(this).data('is_like');
        let root = $(this);

        $.ajax({
            type: "POST",
            url: "/like",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                feed_id : feed_id,
                is_like : is_like,
            },
            success: function(data){
              if(data){
                  $('.like-trigger[data-is_like="1"]').attr('data-original-title', 'Likes ' + data.like +' %').tooltip('hide');
                  $('.like-trigger[data-is_like="0"]').attr('data-original-title', 'Dislikes '+ data.disslike +' %').tooltip('hide');
                  $(root).tooltip('show');
              }
            }
        });
    });

    $(document).on('click','.agree', function(){

        $('.agree-trigger').not($(this)).removeClass('active');
        $(this).toggleClass('active');

        let feed_id = $(this).data('feed');
        let is_agree = $(this).data('is_agree');

        $.ajax({
            type: "POST",
            url: "/agree",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                feed_id : feed_id,
                is_agree : is_agree,
            },
            success: function(data){
                console.log(data);
            }
        });
    });

    $(document).on('click','.repost', function(){

        $(this).toggleClass('active');
        let feed_id = $(this).data('feed');

        $.ajax({
            type: "POST",
            url: "/repost",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                feed_id : feed_id,
            },
            success: function(data){
                console.log(data);
            }
        });
    });

    $(document).on('click','.comment-like', function(){

        let comment_id = $(this).data('comment');
        let is_like = $(this).data('is_like');

        $('.comment-like-box[data-id="'+comment_id+'"] .comment-like-trigger').not($(this)).removeClass('active-comment');
        $(this).toggleClass('active-comment');


        $.ajax({
            type: "POST",
            url: "/comment-like",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                comment_id : comment_id,
                is_like : is_like,
            },
            success: function(data){
              $('.comment-like-box[data-id="'+comment_id+'"] .comment-type-like').find('.count-area').html(data.like);
              $('.comment-like-box[data-id="'+comment_id+'"] .comment-type-diss').find('.count-area').html(data.diss);
            }
        });
    });

});
$('.replay').on('click', function(){
    let id = $(this).data('id');
    $('.comment-replay[data-id="'+id+'"]').toggle();
});

$('.follow-btn').on('click', function(){

    $('.follow-check').toggle();
    let follow_id = $(this).data('follow');

    $.ajax({
        type: "POST",
        url: "/follow",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            follow_id : follow_id,
        },
        success: function(data){

        }
    });
});
$('.block-btn').on('click', function(){

    $('.unblocked-text').toggle();
    $('.blocked-text').toggle();

    let block_id = $(this).data('block');

    $.ajax({
        type: "POST",
        url: "/black-list",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            block_id : block_id,
        },
        success: function(data){

        }
    });
});

$('.show-category').on('change', function(){

    let show_category_id = $(this).data('show');

    $.ajax({
        type: "POST",
        url: "/show-category",

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            show_category_id : show_category_id,
        },
        success: function(data){

        }
    });
});

$('input[id="url"]').on('change', function () {

    $('input[name="article_name"]').css('border','1px solid #CFCBCB');
    let url = $('input[name="url"]').val();

    $.ajax({
        type: "POST",
        url: "/feed/get-url-title",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            url : url,
        },
        success: function(data){
            $('input[name="article_name"]').val(data);
            $('input[name="article_name"]').css('border','1px solid #31a232');
        },
        error: function () {
            $('input[name="article_name"]').val('');
            $('input[name="article_name"]').css('border','1px solid red');
        }
    });
})

$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
$('#imgupload').change(function(){
    $(this).closest('form').submit();
});

$(document).on('click','.peer-main-block' ,function(){
    let content = $(this).find('.hided-peer').html();
    $('.put-clicked-content').html('');
    $('.put-clicked-content').html(content);
});

$(document).on('click','.peer_status_item' ,function(){

    let id = $(this).parent().data('id');
    let value = $(this).data('value');

    $.ajax({
        type: "POST",
        url: "/peer-trust",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            id : id,
            value: value
        },
        success: function(){
            location.reload();
        }
    });
});

$('.delete-comment').on('click', function(){

    let id = $(this).data('id');
    let parent = $(this).data('parent');
    let type = $(this).data('type');


    $.ajax({
        type: "POST",
        url: "/comment/delete",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            id : id,
        },
        success: function(){
            $('.comment-block[data-type="'+type+'"][data-id="'+parent+'"]').fadeOut();
        }
    });
});

$(".admin-remove-btn").on('click', function () {
    if(confirm('Are you sure?')){
        $(this).next().submit();
    }
})

$('.edit-comment').click(function () {
    let id = $(this).data('id');
    $('.edit-comment-block[data-id="'+id+'"]').toggle();
})
$('.edit-comment-btn').click(function () {

    let root = $(this);
    let value = $(this).prev().val();
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "/feed/comment/update",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            id : id,
            value : value,
        },
        success: function(data){
            $(root).prev().val('');
            $('.edited-text[data-id="'+id+'"]').html(data.value);
        }
    });

});

function checkMessages() {
    $.ajax({
        type: "POST",
        url: "/check-messages",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data){
            if(data.result){
                $('.message-check-icon').append(`<i class="fas fa-comments text-danger ml-1 "></i>`);
            }
        }
    });
}


$('.aside-accordion').on('click', function () {
    $(this).find('.toggle_triangle').toggleClass('rotate');
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})



