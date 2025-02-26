<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Category</title>
</head>
<body>
    @if (isset($_SESSION['errors']))
        @foreach ($_SESSION['errors'] as $error)
            <h1>{{ $error }}</h1>
        @endforeach
        @php unset($_SESSION['errors']) @endphp
    @endif

    <form action="{{ $_ENV['BASE_URL'] }}admin/category/add" method="post">
        <input type="text" name="name" placeholder="Tên">
        <button type="submit">Thêm mới</button>
    </form>
</body>
</html>
