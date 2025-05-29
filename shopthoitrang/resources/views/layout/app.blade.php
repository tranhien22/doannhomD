<!DOCTYPE html>
<html lang="vi">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Trang chủ')</title>

    <!-- Giao diện từ mẫu -->
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: Arial;
            color: #333;
            font-size: 0.95em;
            background-image: url("{{ asset('img/bg.png') }}");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <!-- Thêm phần hiển thị thông báo -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div>
        @yield('content')
    </div>

    {{-- Validation script --}}
    <script>
        function validate() {
            var $valid = true;
            document.getElementById("user_info").innerHTML = "";
            document.getElementById("password_info").innerHTML = "";

            var userName = document.getElementById("user_name").value;
            var password = document.getElementById("password").value;

            if (userName == "") {
                document.getElementById("user_info").innerHTML = "required";
                $valid = false;
            }
            if (password == "") {
                document.getElementById("password_info").innerHTML = "required";
                $valid = false;
            }

            return $valid;
        }
    </script>
</body>
</html>
