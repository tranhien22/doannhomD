@extends('admin.dashboard')

@section('content')
    <div class="container">
        <h1>Danh sách người dùng</h1>

        <form action="{{route('user.searchUser')}}" method="GET">
            <input type="text" name="search" placeholder="Search..." class="input-search">
            <button type="submit" class="btn btn-warning">Search</button>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã người dùng</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Cập nhật</th>
                    <th>Xóa</th>
                    <th>Chặn/Mở chặn</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id_user}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            @if($user->is_blocked)
                                <span class="badge bg-danger">Đã chặn</span>
                            @else
                                <span class="badge bg-success">Hoạt động</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('user.updateUser', ['id' => $user->id_user]) }}" class="btn btn-primary">Update</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id_user}}">
                                Delete
                            </button>
                            <!-- Modal xác nhận xóa -->
                            <div class="modal fade" id="deleteModal{{$user->id_user}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$user->id_user}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{$user->id_user}}">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa người dùng <strong>{{$user->name}}</strong> không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <a href="{{route('user.deleteUser', ['id' => $user->id_user]) }}" class="btn btn-danger">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->is_blocked)
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#unblockModal{{$user->id_user}}">
                                    Mở chặn
                                </button>
                                <!-- Modal xác nhận mở chặn -->
                                <div class="modal fade" id="unblockModal{{$user->id_user}}" tabindex="-1" aria-labelledby="unblockModalLabel{{$user->id_user}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="unblockModalLabel{{$user->id_user}}">Xác nhận mở chặn</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn mở chặn người dùng <strong>{{$user->name}}</strong> không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('user.unblock', $user->id_user) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Mở chặn</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#blockModal{{$user->id_user}}">
                                    Chặn
                                </button>
                                <!-- Modal xác nhận chặn -->
                                <div class="modal fade" id="blockModal{{$user->id_user}}" tabindex="-1" aria-labelledby="blockModalLabel{{$user->id_user}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="blockModalLabel{{$user->id_user}}">Xác nhận chặn</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn chặn người dùng <strong>{{$user->name}}</strong> không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <form action="{{ route('user.block', $user->id_user) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">Chặn</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if(session('reload_needed'))
    <script>
        // Tự động reload trang sau 3 giây để cập nhật danh sách
        setTimeout(function() {
            window.location.reload();
        }, 3000);
    </script>
    @endif

    @if($errors->has('error'))
    <script>
        // Hiển thị thông báo lỗi với SweetAlert hoặc alert
        alert('⚠️ ' + '{{ $errors->first("error") }}' + '\n\nTrang sẽ tự động cập nhật sau 3 giây...');
    </script>
    @endif

    @if($errors->has('warning'))
    <script>
        alert('⚠️ Cảnh báo: ' + '{{ $errors->first("warning") }}');
    </script>
    @endif

    <style>
        .input-search {
            width: 30%;
            height: 40px;
            border-radius: 15px;
            padding-left: 15px;
        }

        .btn-warning {
            color: white;
            font-weight: bold;
        }

        .btn-warning:hover {
            color: white;
        }

        table th,
        table td {
            border: 1px solid black;
        }

        table {
            margin-top: 50px;
        }

        /* Style cho modal */
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .modal-body {
            padding: 20px;
            font-size: 16px;
        }

        .modal-title {
            font-weight: 600;
            color: #333;
        }
    </style>
@endsection