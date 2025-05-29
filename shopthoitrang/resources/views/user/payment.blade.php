@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<main class="cart-form">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title">
                    <h4 style="text-align: center;border-bottom: 1px solid gray;padding-bottom: 20px">Giỏ hàng của bạn
                    </h4>
                </div>
                <form action="{{ route('detailsorder.addDetailsOrder') }}" method="get" class="form-cart">
                    @csrf
                    @foreach($product as $item)
                        @if(!empty($item))
                            <div class="card" id="product-item">
                                <div class="card-body">
                                    <div class="product-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="image-product">
                                                    <img src="{{ asset('uploads/productimage/' . $item->image_address_product) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-info">
                                                    <span class="d-flex"><a href="#">
                                                            <h3>{{ $item->name_product }}</h3>
                                                        </a></span>
                                                    <span class="price">Giá: {{ $item->price_product }}VNĐ</span>
                                                    <br>
                                                    <span>Số lượng đặt: {{ $item->quantity_product }}</span>
                                                </div>

                                            </div>
                                            <div class="col-md-2">
                                                <div class="quantity">
                                                    <a href="{{ route('cart.deleteproductcart', ['id' => $item->id_product]) }}"
                                                        class="btn btn-danger">Delete</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="mt-5 info">
                        Thành tiền: <input type="text" name="total" value="{{ $totalAll }}" readonly
                            style="border: none; outline: none; background-color: transparent;">
                    </div>
                    <div class="mt-5">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Nhập Địa Chỉ Giao Hàng:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="address" value="" class="input-address">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-10 mt-5"></div>
                    <div class="col-md-2"><button class="btn btn-danger">Xác Nhận</button></div>
                </form>
            </div>
        </div>
</main>

<style>
.info{
    margin-top: 40px;
}

    .product-info {
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .quantity {
        margin-top: 50px;
    }

    .form-cart .product-item {
        width: 100%;
    }

    .form-cart .product-item img {
        margin-right: 25%;
        margin-left: 25%;
        width: 50%;
        height: 200px;
    }

    .product-info a {
        text-decoration: none;
    }

    .product-info a h3 {
        color: gray;
    }

    .product-info .price {
        font-weight: 600;
        color: red;
    }

    #total {
        background-color: #fff;
        border: 1px solid rgba(145, 158, 171, .239);
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        bottom: 0;
        box-shadow: 0 -4px 20px -1px rgba(40, 124, 234, .15);
        display: flex;
        justify-content: space-between;
        left: 50%;
        margin: auto;
        max-width: 1000px;
        padding: 10px 10px 15px;
        position: fixed;
        transform: translateX(-50%);
        width: 100%;
        z-index: 11;
    }

    .total-card {
        color: red;
        font-weight: 600;
    }

    #product-item {
        max-width: 100%;
        margin-top: 20px
    }

    label {
        margin-top: 10px;
    }

    .input-address {
        border: 1px solid gray;
        width: 100%;
        height: 40px;
        border-radius: 15px;
        padding-left: 20px;
    }

    .cart-form {
        margin-top: 20px;
    }

    /* Alert styles */
    .alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        min-width: 300px;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        text-align: center;
        display: none;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-warning {
        background-color: #fff3cd;
        border: 1px solid #ffeeba;
        color: #856404;
    }

    .alert i {
        margin-right: 10px;
    }

    .input-address.error {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Thêm container cho thông báo
        if (!$('#alert-container').length) {
            $('body').append(`
                <div id="alert-container" class="alert" role="alert">
                    <i class="fa fa-exclamation-circle"></i>
                    <span id="alert-message"></span>
                </div>
            `);
        }

        let lastPaymentClickTime = 0;
        const paymentForm = $('.form-cart');
        
        paymentForm.on('submit', function(e) {
            e.preventDefault();
            
            // Kiểm tra thời gian giữa các lần nhấn
            const currentTime = new Date().getTime();
            const timeDiff = currentTime - lastPaymentClickTime;
            
            if (timeDiff < 10000) { // 10000ms = 10 giây
                const remainingTime = Math.ceil((10000 - timeDiff) / 1000);
                $('#alert-container')
                    .removeClass('alert-danger')
                    .addClass('alert-warning')
                    .find('#alert-message')
                    .text(`Vui lòng đợi ${remainingTime} giây trước khi thanh toán tiếp theo`);
                $('#alert-container').fadeIn();
                
                setTimeout(function() {
                    $('#alert-container').fadeOut();
                }, 2000);
                return;
            }
            
            // Kiểm tra địa chỉ giao hàng
            const address = $('input[name="address"]').val().trim();
            if (!address) {
                $('#alert-container')
                    .removeClass('alert-warning')
                    .addClass('alert-danger')
                    .find('#alert-message')
                    .text('Vui lòng nhập địa chỉ giao hàng để tiếp tục thanh toán');
                $('#alert-container').fadeIn();
                
                // Highlight input địa chỉ
                $('input[name="address"]')
                    .addClass('error')
                    .focus();
                
                // Reset sau 2 giây
                setTimeout(function() {
                    $('input[name="address"]').removeClass('error');
                    $('#alert-container').fadeOut();
                }, 2000);
                return;
            }
            
            // Cập nhật thời điểm nhấn nút
            lastPaymentClickTime = currentTime;
            
            // Submit form
            this.submit();
        });
    });
</script>
@endsection