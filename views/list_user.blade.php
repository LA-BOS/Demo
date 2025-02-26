<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Xin chào, {{ $_SESSION['user']['name'] }} | <a href="{{ $_ENV['BASE_URL'] }}logout">Đăng xuất</a></p>
    
    <nav>
        <ul>
            <li><a href="{{ $_ENV['BASE_URL'] }}admin/user">Quản lý User</a></li>
            <li><a href="{{ $_ENV['BASE_URL'] }}admin/category">Quản lý Category</a></li>
            <li><a href="{{ $_ENV['BASE_URL'] }}admin/product">Quản lý Product</a></li>
        </ul>
    </nav>

    <h1>Danh sách User</h1>
    
    <form action="" method="get">
        <input type="text" name="search" placeholder="Tìm kiếm theo tên" value="{{ $search ?? '' }}">
        <button type="submit">Tìm kiếm</button>
    </form>
    
    <a href="{{ $_ENV['BASE_URL'] }}admin/user/add">Thêm mới</a>
    
    <table border="1">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Username</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['age'] }}</td>
                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}admin/user/update/{{ $value['id'] }}">Sửa</a>
                        <a href="{{ $_ENV['BASE_URL'] }}admin/user/delete/{{ $value['id'] }}" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>