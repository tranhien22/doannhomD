<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <!-- <ul class="header-links pull-right">
                    <li><a href="{{ route('signout') }}"><i class="fa fa-user-o"></i> Logout</a></li>
                </ul> -->
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
                </ul>

            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <div class="header-logo">
                            <a href="{{ route('home.index') }}" class="logo">
                                <img src="{{ asset('./img/logo.png')}} " alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-5">
                        <div class="header-search">
                            <form action="{{ route('user.searchProduct') }}" method="GET" class="d-flex justify-content-center mb-4" style="max-width: 600px; margin: auto;">
                                <div class="input-group shadow-sm">
                                    <input
                                        type="text"
                                        name="keyword"
                                        class="form-control rounded-start-pill input-product"
                                        placeholder="🔍 Tìm kiếm sản phẩm..."
                                        aria-label="Tìm kiếm"
                                        required>
                                    <button class="btn btn-success rounded-end-pill px-4 search-btn" type="submit">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-5 clearfix">
                        <div class="header-ctn d-flex align-items-center gap-3">
                            <a href="{{ route('post.indexListPostUser') }}" class="header-link">
                                <i class="fa fa-newspaper-o"></i>
                                <span>Bài viết</span>
                            </a>
                            @if(Session::get('id_user'))
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle header-link" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-industry"></i>
                                        <span>Nhà Sản Xuất</span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="manufacturerDropdown">
                                        @foreach ($manufacturers as $manufacturer)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('manufacturer.products', $manufacturer->id_manufacturer) }}">
                                                {{ $manufacturer->name_manufacturer }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ route('cart.indexCart') }}" class="header-link position-relative">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng</span>
                                    <span class="cart-badge" id="header-cart-count">{{ $cartCount }}</span>
                                </a>
                                <a href="{{ route('order.orderIndex') }}" class="header-link position-relative">
                                    <i class="fa-solid fa-file-invoice"></i>
                                    <span>Đơn hàng</span>
                                    <span class="order-badge" id="header-order-count">{{ $orderCount }}</span>
                                </a>
                                <a href="{{ route('signout') }}" class="header-link">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            @else
                                <a href="{{ route('user.indexlogin') }}" class="header-link">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <span>Đăng nhập</span>
                                </a>
                            @endif
                            <a href="#" class="header-link menu-toggle">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    @yield('content')

</body>
<style>
    #header {
        background: #000120 !important;
    }

    .logo img {
        object-fit: fill;
        width: 200px;
        height: 100px;
        padding-right: 20px;
    }

    * a {
        text-decoration: none;
    }

    .input-product {
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        height: 40px;
        width: 70%;
        padding-left: 20px;
    }

    .search-btn {
        width: 15%;
    }

    .header-ctn {
        display: flex !important;
        align-items: center;
        gap: 20px;
        padding-right: 50px;
    }

    .header-link {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #fff;
        text-decoration: none;
        position: relative;
        padding: 0 8px;
        font-size: 15px;
        transition: color 0.2s;
        font-weight: 500;
    }

    .header-link:hover {
        color: #ff523b;
    }

    .cart-badge, .order-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #ff523b;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        min-width: 18px;
        text-align: center;
    }

    .header-ctn > div {
        position: relative;
        display: inline-block;
    }
</style>

<script>
    // Cập nhật số lượng giỏ hàng và đơn hàng khi trang được tải
    $(document).ready(function() {
        updateCartCount();
        updateOrderCount();
    });

    // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
    function updateCartCount() {
        $.ajax({
            url: "{{ route('cart.getCount') }}",
            method: 'GET',
            success: function(response) {
                $('#header-cart-count').text(response.count);
            }
        });
    }

    // Hàm cập nhật số lượng đơn hàng
    function updateOrderCount() {
        $.ajax({
            url: "{{ route('order.getCount') }}",
            method: 'GET',
            success: function(response) {
                $('#header-order-count').text(response.count);
            }
        });
    }

    // Cập nhật số lượng sau mỗi 30 giây
    setInterval(function() {
        updateCartCount();
        updateOrderCount();
    }, 30000);
</script>

</html>