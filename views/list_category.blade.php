<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= $_ENV['BASE_URL'] ?>category/add">Thêm mới</a>
    <h1>Danh sách Category</h1>
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
                        <a href="{{ $_ENV['BASE_URL'] }}category/update/{{ $value['id'] }}">Sửa</a>
                        <a href="{{ $_ENV['BASE_URL'] }}category/delete/{{ $value['id'] }}" onclick="return confirm('Ban chac muon xoa?')">Xóa</a>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>