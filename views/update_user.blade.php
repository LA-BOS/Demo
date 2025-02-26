<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật User</title>
</head>
<body>
    <form action="{{ $_ENV['BASE_URL'] }}admin/user/update/{{ $user['id'] }}" method="post">
        <input type="text" name="name" value="{{ $user['name'] }}"> <br>
        <input type="number" name="age" value="{{ $user['age'] }}"> <br>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
