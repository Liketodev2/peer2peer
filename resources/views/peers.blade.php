@extends('layouts.main')
@section('content')
    <div class="d-xl-flex peers_content">
        <aside class="asides left_aside">
            <div class="pb-4 mb-2">
                <ul class="p-0 m-0 active list-unstyled">
                    <li class="active"><a href="#">All</a></li>
                    <li><a href="#">Very Trustworthy [5]</a></li>
                    <li><a href="#">Trustworthy [4]</a></li>
                    <li><a href="#">OK Trust [3]</a></li>
                    <li><a href="#">Untrustworthy [2]</a></li>
                    <li><a href="#">Not my peer [1]</a></li>
                    <li><a href="#">BLOCKED [0]</a></li>
                </ul>
            </div>
        </aside>
        <main class="flex-1 main-content px-lg-4 py-5">
            <div class="d-flex justify-content-center align-items-center">
                <div class="mr-3 color-red">Sort by</div>
                <ul class="d-flex">
                    <li><a href="#">ABC</a></li>
                    <li class="active"><a href="#">Date added</a></li>
                    <li><a href="#">Date created</a></li>
                </ul>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">CNN [ Very Trustworthy - Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Frank Smith [ Trustworthy - Change]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Go News [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Harry Smith [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">HSBC [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">International [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">K-Pop Man [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Mr-Anonymou3x3w0c [ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">NBC[ Very Trustworthy -Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Sam Binger [ OK - Change ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">Vice [ Untrustworthy ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
            <div class="alert bg-light my-2" role="alert">
                <a href="#">WSJ [ Very trustworthy ]</a>
                <i class="fa fa-eye color-gray"></i>
            </div>
        </main>
        <aside class="asides right_aside">
            <div class="aside-accordion alert p-0">
                <div class="btn btn-red w-100 d-flex justify-content-between align-items-center">
                    <a class="d-flex justify-content-between align-items-center w-100" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <div class="title">Profile</div>
                        <img src="img/Polygon%204.png" width="21" height="12">
                    </a>
                    <img src="img/x%20(5).svg" alt="" class="ml-3" data-dismiss="alert" aria-label="Close">
                </div>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                    <div class="card card-body p-1 bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            <div class="info_name">Name:</div>
                            <div class="info_name-description">CNN Politics</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Feed identifier:</div>
                            <div class="info_name-description">Hashn2xf043) 9zf9043Jfasdffasdfasf</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Author:</div>
                            <div class="info_name-description">CNN</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Custom Name:</div>
                            <div class="info_name-description">not specified</div>
                            <i class="fa fa-pencil"></i>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Status:</div>
                            <div class="info_name-description">Followed in US Section</div>
                            <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                            <i class="fas fa-pencil-alt ml-auto"></i>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Peer status:</div>
                            <div class="info_name-description">Very Trust Worthy</div>
                            <i class="fa fa-pencil"></i>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Date created:</div>
                            <div class="info_name-description">c 2018</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="info_name">Followers:</div>
                            <div class="info_name-description">242</div>
                        </div>
                        <div class="color-red title my-4">Other Feeds from Author:</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">CNN World …</div>
                            <div class="info_name-description">
                                <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                                <a href="#" class="ml-2"><img src="img/plus%20(1).svg" alt=""></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">CNN World …</div>
                            <div class="info_name-description">
                                <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                                <a href="#" class="ml-2"><img src="img/plus%20(1).svg" alt=""></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">CNN World …</div>
                            <div class="info_name-description">
                                <a href="#" class="ml-2"><img src="img/visibility.svg" alt=""></a>
                                <a href="#" class="ml-2"><img src="img/plus%20(1).svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection
