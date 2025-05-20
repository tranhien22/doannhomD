@extends('admin.dashboard')


<!-- Product section-->
@section('content')
<main class="listmanufacturer-form">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Quản Lý Bài Viết</h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('post.indexaddpost') }}" class="btn btn-success" data-toggle="modal"><i
                                    class="bi bi-pencil"></i><span>Thêm Bài Viết</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Mã bài viết</th>
                            <th>Tên bài viết</th>
                            <th>Nội dung bài viết</th>
                            <th>Tên ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id_post }}</td>
                                <td>{{ $post->title_post }}</td>
                                <td>{{ $post->content_post }}</td>
                                <td>
                                    <ul>
                                        @foreach($postImages[$post->id_post] as $imageName)
                                            <img src="{{ asset('uploads/post/' . $imageName) }}" width="150" height="150">
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('post.indexupdatepost', ['id' => $post->id_post]) }}"
                                        class="mx-1 btn btn-primary">Sửa</a>
                                </td>
                                <td>
                                    <a href="{{ route('post.deletepost', ['id' => $post->id_post]) }}"
                                        class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                         Xóa
                                     </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<style>
    table th,td{
        border: 1px solid black;
    }
</style>
@endsection