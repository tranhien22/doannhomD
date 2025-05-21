@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<body>
    <header style="margin-top: 200px;">
        <form action="{{ route('post.searchpost') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="search">
                        <div class="row">
                            <div class="col-md-10"><input type="text" id="input-search" name="input-search"
                                    placeholder="Nhập tên hoặc nội dung bài viết..."></div>
                            <div class="col-md-2"><button class="btn btn-danger">Tìm kiếm</button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>
    </header>
    <div class="container">
        <div class="content">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <h2><span>Tin mới cập nhật</span></h2>
                    @foreach ($posts as $index => $post)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="d-block w-100">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($post->images as $key => $image)
                                    @if($key == 0)
                                    <img src="{{ asset('uploads/post/' . $image->file_name) }}" alt="" width="100%" height="auto"
                                        style="border-radius:15px;">
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <h3><a
                                            href="{{ route('post.detailpost', ['id' => $post->id_post]) }}">{{ $post->title_post }}</a>
                                    </h3>
                                    <div class="content_text" id="postContent_{{ $loop->iteration }}"
                                        style="white-space: pre-line;">{{ $post->content_post }}</div>
                                    <p><i class="fa fa-calendar"></i> Ngày đăng: {{ $post->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h2><span>Tin tức</span></h2>
            @foreach($postsnew as $item)
            <div class="card">
                <div class="body-card">
                    <div class="row">
                        <div class="col-md-2">
                            @foreach ($item->images as $key => $image)
                            @if ($key == 0)
                            <img src="{{ asset('uploads/post/' . $image->file_name) }}" alt="" width="100%" height="auto"
                                style="border-radius:5px;">
                                @endif
                                @endforeach
                        </div>
                        <div class="col-md-10">
                            <h4><a
                                    href="{{ route('post.detailpost', ['id' => $item->id_post]) }}">{{ $item->title_post }}</a>
                            </h4>
                            <?php
                                                $maxLength = 500;
                                                $content = $item->content_post;
                                                if (strlen($content) > $maxLength) {
                                                    $trimmedContent = substr($content, 0, $maxLength) . '...';
                                                    echo '<p id="postContent_' . $item->id . '" class="content_text">' . $trimmedContent . '</p>';
                                                } else {
                                                    echo '<p id="postContent_' . $item->id . '" class="content_text">' . $content . '</p>';
                                                }
                                                                                                ?>
                            <p><i class="fa fa-calendar"></i> Ngày đăng: {{ $item->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <footer>
            
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Kích hoạt tự động chuyển slide và thiết lập thời gian chuyển slide là 5000 mili giây
    var myCarousel = document.getElementById('carouselExampleDark');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 5000
    });

    // Bắt sự kiện khi carousel chuyển slide
    myCarousel.addEventListener('slid.bs.carousel', function() {
        // Nếu đang ở slide cuối cùng, điều hướng carousel về slide đầu tiên
        if (carousel.getActiveIndex() === 3) {
            carousel.to(0);
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        var maxLength = 500;
        @foreach($posts as $post)
        var content = document.getElementById('postContent_{{ $loop->iteration }}').innerHTML;
        if (content.length > maxLength) {
            var trimmedContent = content.substring(0, maxLength) + '...';
            document.getElementById('postContent_{{ $loop->iteration }}').innerHTML = trimmedContent;
        }
        @endforeach
    });
    document.addEventListener('DOMContentLoaded', function() {
        var maxLength = 500;
        var contents = document.querySelectorAll('.content_text');
        contents.forEach(function(content) {
            var text = content.textContent;
            if (text.length > maxLength) {
                var trimmedText = text.substring(0, maxLength) + '...';
                content.textContent = trimmedText;
            }
        });
    });
    </script>
    <style>
    .carousel-inner {
        width: 75%;
        margin-left: 12%;
        margin-right: 12%;
    }

    .content h2 {
        margin-bottom: 30px;
        font-weight: 1000;
    }

    .content h2 span {
        border-bottom: 5px solid red;
        padding-bottom: 5px;
    }

    .carousel-item p i,
    .body-card p i {
        color: #1a6db4 !important;
    }

    .carousel-item p,
    .body-card p {
        color: gray;
    }

    .carousel-item h3,
    .body-card h4 {
        font-weight: bold;
    }

    .carousel-item a,
    .body-card h4 a {
        text-decoration: none;
        color: black;
        font-size: 25px;
    }

    .carousel-item a:hover,
    .body-card h4 a:hover {
        color: red;
    }

    .carousel-item img{
        height: 300px;
        object-fit: cover;
    }

    .content_text {
        color: black !important;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .item {
        margin-top: 100px;
    }

    .body-card {
        border: none;
    }

    .body-card h4 {
        font-weight: 700;
        padding-right: 20px;
        padding-top: 10px;
    }

    .body-card img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .card {
        margin-top: 20px;
    }

    .paginate {
        margin-top: 20px;
    }

    #input-search {
        width: 100%;
        border-radius: 25px;
        padding: 20px;
        color: gray;
        font-size: 20px;
    }

    .btn-danger {
        height: 100%;
        font-weight: 600;
        font-size: 15px;
        width: 100%;
        font-size: 20px;
    }

    form {
        margin-bottom: 50px;
    }

    #carouselExampleDark{
        margin-bottom: 90px;
    }

    footer{
        background: #000120 !important;
        height: 50px;
        margin-top: 50px;
    }
    </style>
</body>

</html>
@endsection