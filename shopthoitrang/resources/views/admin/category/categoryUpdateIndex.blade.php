@extends('admin.dashboard')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Sửa Danh Mục</h3>
                        <div class="card-body">
                            <form action="{{ route('category.updateCategory') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input name="id" type="hidden" value="{{$category->id_category}}">
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                           value="{{ $category->name_category }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                 <div class="form-group mb-3">
                                    <input 
                                        type="file" 
                                        placeholder="text" 
                                        id="image_categori" 
                                        class="form-control" 
                                        name="image_categori"                                       
                                    >
                                    @if ($errors->has('image_categori'))
                                        <span class="text-danger">{{ $errors->first('image_categori') }}</span>
                                    @endif
                                </div>
                                 <div class="form-group mb-3">
                                    <img src="{{ asset('uploads/categoriesimage/' . $category->image_category) }}" 
                                         alt="{{ $category->image_category }}" 
                                         class="img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Sửa</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection