<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <h1>Danh sách Category</h1>
    
    <form action="" method="get">
        <input type="text" name="search" placeholder="Tìm kiếm theo tên" value="{{ $search ?? '' }}">
        <button type="submit">Tìm kiếm</button>
    </form>
    <a href="<?= $_ENV['BASE_URL'] ?>admin/category/add">Thêm mới</a>
    <table border="1">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}admin/category/update/{{ $value['id'] }}">Sửa</a>
                        <a href="{{ $_ENV['BASE_URL'] }}admin/category/delete/{{ $value['id'] }}" onclick="return confirm('Ban chac muon xoa?')">Xóa</a>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>