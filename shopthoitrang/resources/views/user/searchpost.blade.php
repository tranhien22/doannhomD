@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<body>
    <header style="margin-top: 100px"></header>
    <div class="content">
        <div class="container">
            <h2><span>Kết quả tìm kiếm</span></h2>
            @foreach ($posts as $post)
            <div class="card">
                <div class="body-card">
                    <div class="row">
                        <div class="col-md-2">
                            @foreach($post->images as $key => $image)
                            @if ($key == 0)
                                <img src="{{ asset('uploads/post/' . $image->file_name) }}" alt="" width="100%" height="auto"
                                    style="border-radius:5px;">
                            @endif
                            @endforeach
                        </div>
                        <div class="col-md-10">
                            <h4><a
                                    href="{{ route('post.detailpost', ['id' => $post->id_post]) }}">{{ $post->title_post }}</a>
                            </h4>
                            <?php
                $maxLength = 300;
                $content = $post->content_post;
                if (strlen($content) > $maxLength) {
                    $trimmedContent = substr($content, 0, $maxLength) . '...';
                    echo '<p id="postContent_' . $post->id . '" class="content_text">' . $trimmedContent . '</p>';
                } else {
                    echo '<p id="postContent_' . $post->id . '" class="content_text">' . $content . '</p>';
                }
            ?>
                            <p><i class="fa fa-calendar"></i> Ngày đăng: {{ $post->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <footer></footer>
    <style>
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
    }

    .carousel-item a:hover,
    .body-card h4 a:hover {
        color: red;
    }

    .content_text {
        color: black !important;
        margin-bottom: 20px;
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
    </style>
</body>
@endsection