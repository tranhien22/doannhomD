@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<body>
    <header></header>
    <div class="container">
        <div class="content">
            <div class="wrap">
                @foreach ($file_name_image_post as $index => $image)
                    @if ($index == 0)
                        <img src="{{ asset('uploads/post/' . $image) }}" alt="">
                    @endif
                @endforeach
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>{{ $post->title_post }}</h2>
                    <div class="auth">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-auth">
                                    <p><i class="fa fa-calendar"></i> Ngày đăng {{ $post->created_at }} <span>| <i
                                                class="fa fa-calendar"></i> Cập nhật {{ $post->updated_at }}</span> </p>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="content-card">
                        <span>{{ $post->content_post }}</span>
                    </div>@foreach ($file_name_image_post as $index => $image)
                        @if ($index != 0)
                            <div class="image-post">
                                <img src="{{ asset('uploads/post/' . $image) }}" alt="">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
    <style>
        .content{
            margin-top: 80px;
        }
        .wrap {
            width: 100%;
            height: 350px;
            position: relative;
            z-index: 1;
        }

        .wrap img {
            min-width: 100%;
            height: 100%;
            border-radius: 15px;
            object-fit: cover;
        }

        .card {
            border-radius: 15px;
            margin-left: 5%;
            margin-right: 5%;
            position: relative;
            top: -80px;
            z-index: 2;
            box-shadow: 0px 8px 10px -10px rgba(0, 0, 0, 0.75), 8px 0px 10px -10px rgba(0, 0, 0, 0.75);
        }

        .card h2 {
            color: #4d4d4d;
            font-weight: 600;
            font-size: 40px;
        }

        .info-auth h5 {
            margin-top: 2%;
            color: red;
            font-weight: 600;
        }

        .info-auth p {
            font-size: 15px;
            margin-bottom: 35px;
            margin-top: 10px;
        }

        .info-auth i {
            color: #2e9fff;
            font-weight: 400;
        }

        .content-card h5 {
            font-weight: bold;
        }

        .card-body {
            margin-left: 2%;
            margin-right: 2%;
        }

        .image-post {
            height: 350px;
            /* Đặt chiều cao cố định */
            overflow: hidden;
            /* Ẩn bất kỳ phần nào vượt ra ngoài khung */
        }

        .image-post .row {
            height: 100%;
            margin-top: 10px;
        }

        .image-post{
            border: 2px solid #2e9fff;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .image-post img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content-card span{
            font-size: 20px;
        }
    </style>
</body>
@endsection