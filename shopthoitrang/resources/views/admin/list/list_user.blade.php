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
                            <a href="{{route('user.deleteUser', ['id' => $user->id_user]) }}" class="btn btn-danger">Delete</a>
                        </td>
                        <td>
                            @if($user->is_blocked)
                                <form action="{{ route('user.unblock', $user->id_user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Mở chặn</button>
                                </form>
                            @else
                                <form action="{{ route('user.block', $user->id_user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Chặn</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
    </style>
@endsection