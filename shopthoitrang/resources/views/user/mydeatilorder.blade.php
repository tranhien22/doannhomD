@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main class="cart-form">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title">
                    <h4 style="text-align: center;border-bottom: 1px solid gray;padding-bottom: 20px">Chi tiết hóa đơn
                        của bạn
                    </h4>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('order.orderIndex') }}">
                    @foreach($order as $item)
                        @if(!empty($item))
                            <div class="card" id="product-item">
                                <div class="card-body">
                                    <div class="product-item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="image-product">
                                                    <img style="height:250px;"
                                                        src="{{ asset('uploads/productimage/' . $item->image_address_product) }}"
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
                                                    <span>Số lượng đặt: {{ $item->quantity_detailsorder }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach  
                    <div class="col-md-2 mt-5"><button class="btn btn-danger btn-backup">Quay Lại</button></div>
                </form>
            </div>
        </div>
</main>

<style>
.btn-backup{
    margin-top: 40px;
}

    .cart-form {
        margin-top: 20px;
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
</style>

<script>
    const plus = document.querySelector(".plus"),
        minus = document.querySelector(".minus"),
        num = document.querySelector(".num");
    let a = 1;
    plus.addEventListener("click", () => {
        a++;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    });
    minus.addEventListener("click", () => {
        if (a > 1) {
            a--;
            a = (a < 10) ? "0" + a : a;
            num.innerText = a;
        }

    });
</script>
@endsection