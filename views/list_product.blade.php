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

    <h1>Danh sách Product</h1>
    
    <form action="" method="get">
        <input type="text" name="search" placeholder="Tìm kiếm theo tên" value="{{ $search ?? '' }}">
        <button type="submit">Tìm kiếm</button>
    </form>
    <a href="<?= $_ENV['BASE_URL'] ?>admin/product/add">Thêm sản phẩm</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Create_At</th>
                <th>Update_At</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$value['category_name']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>
                        @if ($value['img_thumbnail']!=null)
                            <img src="{{$_ENV['BASE_URL'].$value['img_thumbnail']}}" style="width: 100px">
                        @endif
                    </td>
                    <td>{{$value['description']}}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($value['created_at'])) }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($value['updated_at'])) }}</td>
                    <td>
                    <a href="{{ $_ENV['BASE_URL'] }}admin/product/update/{{ $value['id'] }}">Sửa</a>
                    <a href="{{ $_ENV['BASE_URL'] }}admin/product/delete/{{ $value['id'] }}" onclick="return confirm('Ban chac muon xoa?')">Xóa</a>
                    </td>
                </tr>
            
            @endforeach
    </table>
</body>
</html>