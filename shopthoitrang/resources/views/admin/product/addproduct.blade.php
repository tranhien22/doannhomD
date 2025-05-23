@extends('admin.dashboard')

@section('content')
<main class="addproduct-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h3 class="card-header text-center">Thêm Sản Phẩm</h3>
                    <div class="card-body">
                        <form action="{{ route('product.addproduct') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Danh mục</span></div>
                                            <div class="col-md-9">
                                                <select id="id_category" name="id_category" class="form-control"
                                                    required autofocus onchange="handleCategoryChange()">
                                                    <option value="" disabled selected hidden>--Chọn danh mục--</option>
                                                    @foreach($categorys as $category)
                                                    <option value="{{ $category->id_category }}" {{ old('id_category') == $category->id_category ? 'selected' : '' }}>
                                                        {{ $category->name_category }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_category" name="selected_category" value="{{ old('id_category') }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('id_category'))
                                        <span class="text-danger">{{ $errors->first('id_category') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Hãng sản xuất</span></div>
                                            <div class="col-md-9">
                                                <select id="id_manufacturer" name="id_manufacturer"
                                                    class="form-control" required autofocus onchange="handleManufacturerChange()">
                                                    <option value="" disabled selected hidden>--Chọn hãng sản xuất--</option>
                                                    @foreach($manufacturers as $manufacturer)
                                                    <option value="{{ $manufacturer->id_manufacturer }}" {{ old('id_manufacturer') == $manufacturer->id_manufacturer ? 'selected' : '' }}>
                                                        {{ $manufacturer->name_manufacturer }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_manufacturer" name="selected_manufacturer" value="{{ old('id_manufacturer') }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('id_manufacturer'))
                                        <span class="text-danger">{{ $errors->first('id_manufacturer') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Tên sản phẩm</span></div>
                                            <div class="col-md-9"> <input type="text" id="name_product"
                                                    class="form-control" name="name_product" required autofocus oninput="validateProductName(this)" value="{{ old('name_product') }}">
                                                <small class="text-muted">Không quá 100 ký tự</small>
                                                <span class="text-danger" id="name_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('name_product'))
                                        <span class="text-danger">{{ $errors->first('name_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Số lượng</span></div>
                                            <div class="col-md-9"> <input type="text" id="quantity_product"
                                                    class="form-control" name="quantity_product" required autofocus oninput="validateQuantity(this)" value="{{ old('quantity_product') }}">
                                                <small class="text-muted">Chỉ nhập số nguyên</small>
                                                <span class="text-danger" id="quantity_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('quantity_product'))
                                        <span class="text-danger">{{ $errors->first('quantity_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Kích thước</span></div>
                                            <div class="col-md-9"> <input type="text" id="sizes"
                                                    class="form-control" name="sizes" placeholder="VD: S,M,L,XL" oninput="validateSizes(this)" value="{{ old('sizes') }}">
                                                <small class="text-muted">Chỉ nhập số và chữ, không quá 10 ký tự</small>
                                                <span class="text-danger" id="sizes_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('sizes'))
                                        <span class="text-danger">{{ $errors->first('sizes') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Giá</span></div>
                                            <div class="col-md-9"> <input type="text" id="price_product"
                                                    class="form-control" name="price_product" required autofocus oninput="validatePrice(this)" value="{{ old('price_product') }}">
                                                <small class="text-muted">Chỉ nhập ký tự số</small>
                                                <span class="text-danger" id="price_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('price_product'))
                                        <span class="text-danger">{{ $errors->first('price_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Màu sắc</span></div>
                                            <div class="col-md-9"> <input type="text" id="colors"
                                                    class="form-control" name="colors" placeholder="VD: Đỏ,Xanh,Đen" value="{{ old('colors') }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('colors'))
                                        <span class="text-danger">{{ $errors->first('colors') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Ảnh sản phẩm</span></div>
                                            <div class="col-md-9">
                                                <input type="file" id="image_address_product"
                                                    class="form-control" name="image_address_product" required accept="image/png, image/jpeg, image/jpg, image/gif" onchange="validateImage(this)">
                                                <span class="text-danger" id="image_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Mô tả</span></div>
                                            <div class="col-md-9">
                                                <textarea id="describe_product" class="form-control" name="describe_product" required autofocus oninput="validateDescription(this)" rows="4" style="font-size: 1.1rem;">{{ old('describe_product') }}</textarea>
                                                <small class="text-muted">Không quá 500 ký tự</small>
                                                <span class="text-danger" id="describe_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('describe_product'))
                                        <span class="text-danger">{{ $errors->first('describe_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Thông số</span></div>
                                            <div class="col-md-9">
                                                <textarea id="specifications" class="form-control" name="specifications" required autofocus oninput="validateSpecifications(this)" rows="4" style="font-size: 1.1rem;">{{ old('specifications') }}</textarea>
                                                <small class="text-muted">Không quá 500 ký tự</small>
                                                <span class="text-danger" id="specifications_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row btn_login">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6"><a href="#"></a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-grid mx-auto">
                                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function handleCategoryChange() {
        var selectedCategory = document.getElementById('id_category').value;
        document.getElementById('selected_category').value = selectedCategory;
    }

    function handleManufacturerChange() {
        var selectedManufacturer = document.getElementById('id_manufacturer').value;
        document.getElementById('selected_manufacturer').value = selectedManufacturer;
    }

    function validateProductName(input) {
        const maxLength = 100;
        const errorElement = document.getElementById('name_product_error');
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá 100 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateQuantity(input) {
        const errorElement = document.getElementById('quantity_product_error');
        if (!/^\d+$/.test(input.value.trim())) {
            errorElement.textContent = 'Yêu cầu nhập trường chỉ nhập ký tự số nguyên';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validatePrice(input) {
        const errorElement = document.getElementById('price_product_error');
        if (!/^\d+$/.test(input.value.trim())) {
            errorElement.textContent = 'Trường chữ nhập ký tự số yêu cầu nhập lại';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateSizes(input) {
        const errorElement = document.getElementById('sizes_error');
        const regex = /^[a-zA-Z0-9,]{1,10}$/;
        if (!regex.test(input.value)) {
            errorElement.textContent = 'Bạn đã nhập sai ký tự ngoài số và chữ yêu cầu nhập lại';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateDescription(input) {
        const maxLength = 500;
        const errorElement = document.getElementById('describe_product_error');
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá ký tự yêu cầu chỉ nhập không quá 500 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateImage(input) {
        const errorElement = document.getElementById('image_error');
        if (!input.value) {
            errorElement.textContent = 'Vui lòng chọn ảnh sản phẩm';
            return false;
        }
        const allowedExtensions = /\.(jpg|jpeg|png|gif)$/i;
        if (!allowedExtensions.exec(input.value)) {
            errorElement.textContent = 'Chỉ cho phép file ảnh jpg, jpeg, png, gif';
            input.value = '';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateSpecifications(input) {
        const errorElement = document.getElementById('specifications_error');
        const maxLength = 500;
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá 500 ký tự, yêu cầu chỉ nhập không quá 500 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateForm() {
        const nameValid = validateProductName(document.getElementById('name_product'));
        const quantityValid = validateQuantity(document.getElementById('quantity_product'));
        const priceValid = validatePrice(document.getElementById('price_product'));
        const sizesValid = validateSizes(document.getElementById('sizes'));
        const descriptionValid = validateDescription(document.getElementById('describe_product'));
        const imageValid = validateImage(document.getElementById('image_address_product'));
        const specificationsValid = validateSpecifications(document.getElementById('specifications'));
        return nameValid && quantityValid && priceValid && sizesValid && descriptionValid && imageValid && specificationsValid;
    }
</script>
@endsection