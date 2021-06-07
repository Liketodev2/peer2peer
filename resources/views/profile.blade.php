@extends('layouts.main')
@section('content')

    <div class="d-xl-flex">
        @include('areas.feed-left-side')
        <div class="flex-1 profile-content p-4">
            <div class="my-profile-content">
                <h1 class="title">My Profile</h1>
                <div class="d-flex align-items-center p-4">
                    <div class="mr-4 prof-img">
                        <div class="upload-img">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                                <img src="img/Group%20103.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between ">
                            <div class="name">Name Surname</div>
                            <i class="fas fa-pencil-alt ml-5"></i>
                        </div>
                        <div class="username mb-3">UserName</div>
                        <div class="d-flex">
                            <div><i class="far fa-envelope color-red mr-1"></i>example@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <h1 class="title">Profile</h1>
                <div class="d-flex align-items-center p-4">
                    <img class="img-fluid prof-img mr-4" alt="">
                    <div>
                        <div class="name">Name Surname</div>
                        <div class="username mb-3">UserName</div>
                        <div class="d-flex">
                            <button class="btn-red mr-3 w-90">Follow</button>
                            <div role="button" class="chat-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="title">Feeds</h1>
            <div class="color-gray my-3">
                Showing 1 - 25 of 11228 results.
            </div>
            <div class="">
                <div class="card-body">
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">10 things to know about interest rates</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Finance</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Why Trump will fail</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">US politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Why Aristotle was more right than wrong</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Philosophy</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Macbook Pro, another Apple loser</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Tech</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">My trip to Israel</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Travel</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Lipid Profiles are so 90s</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Health</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Europe’s Aging Crisis</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Europe Politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">10 PIctures of Best Places to Travel</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Travel</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">The Petro is released in Venezuela</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Venezuela</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Federer Wins US Open left handed</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Tennis</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>

                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">The real China-how free speech is stopped</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Europe Politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Sony RX100 on sale, best travel camera</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Finance</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">10 things to know about interest rates</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Venezuela</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Why Trump will fail</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">US politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Why Aristotle was more right than wrong</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Philosophy</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Macbook Pro, another Apple loser</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Tech</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">My trip to Israel</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Travel</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Lipid Profiles are so 90s</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Health</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Europe’s Aging Crisis</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Europe Politics</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">10 PIctures of Best Places to Travel</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Travel</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">The Petro is released in Venezuela</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Venezuela</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Federer Wins US Open left handed</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">Tennis</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">The real China-how free speech is stopped</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">China</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                    <div class="d-flex row-news">
                        <div class="w-40"><a href="#">Sony RX100 on sale, best travel camera</a></div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">World</div>
                        <div class="mx-auto flex-1 d-flex pl-4">BH photo</div>
                        <div class="mx-auto flex-1 d-flex justify-content-center">12:10</div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @include('areas.feed-right-side')
    </div>

@endsection
