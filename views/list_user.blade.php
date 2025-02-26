<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= $_ENV['BASE_URL'] ?>user/add">Thêm mới</a>
    <h1>Danh sách User</h1>
    <table border="1">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Username</th>
                <th>Age</th>
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
                        <a href="{{ $_ENV['BASE_URL'] }}user/update/{{ $value['id'] }}">Sửa</a>
                        <a href="{{ $_ENV['BASE_URL'] }}user/delete/{{ $value['id'] }}" onclick="return confirm('Ban chac muon xoa?')">Xóa</a>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>