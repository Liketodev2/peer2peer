@extends('layouts.main')
@section('content')
    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <main class="flex-1 main-content">
            <div class="mt-4">
                <div class="accordion px-lg-5">
                    <div class="card alert alert-dismissible fade show">
                        <div class="card-header">
                            Black list
                        </div>
                        <div class="card-body">
                            @if($items->count() > 0)
                                @foreach($items as $item)
                                    <div class="d-flex">
                                        <div class=" w-40 text-left">{{\App\Http\Controllers\FunctionController::userTypeName($item->block_id)}}</div>
                                        <div class="flex-1 text-right">
                                            <button class="btn btn-light btn-sm admin-remove-btn w-60"><i class="fas fa-trash text-danger"></i></button>
                                            <form action="{{route('remove-from-black',$item->id)}}" method="POST" class="d-none admin-remove-form">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                Black list is empty
                            @endif
                        </div>
                             <div class="d-flex justify-content-center mt-4">
                                 {{$items->links('pagination::bootstrap-4')}}
                             </div>
                    </div>
                </div>
            </div>
        </main>
        @include('areas.feed-right-side')
    </div>
@endsection
