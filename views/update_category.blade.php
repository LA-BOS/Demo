<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật Category</title>
</head>
<body>
    <form action="{{ $_ENV['BASE_URL'] }}admin/category/update/{{ $category['id'] }}" method="post">
        <input type="text" name="name" value="{{ $category['name'] }}"> <br>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
