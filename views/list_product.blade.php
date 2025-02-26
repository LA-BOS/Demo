<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= $_ENV['BASE_URL'] ?>product/add">Thêm sản phẩm</a>
    <h1>Danh sách sản phẩm</h1>
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
                    <a href="{{ $_ENV['BASE_URL'] }}product/update/{{ $value['id'] }}">Sửa</a>
                    <a href="{{ $_ENV['BASE_URL'] }}product/delete/{{ $value['id'] }}" onclick="return confirm('Ban chac muon xoa?')">Xóa</a>
                    </td>
                </tr>
            
            @endforeach
    </table>
</body>
</html>