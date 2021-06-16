<div class="user-my_chat col-9 ml-auto mb-3">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div class="name">{{\App\Http\Controllers\FunctionController::userTypeName($message->from_id)}}</div>
        <div class="time">{{$message->created_at}} <i class="fa fa-trash text-danger ml-2 remove-chat-message" data-id="{{$message->id}}" style="cursor: pointer" aria-hidden="true"></i></div>
    </div>
    <div class="bg-dark">
        {{$message->message}}
    </div>
</div>
