<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Xin chào, {{ $_SESSION['user']['name'] }}</p>
    
    <ul>
        <li><a href="{{ $_ENV['BASE_URL'] }}user">Quản lý User</a></li>
        <li><a href="{{ $_ENV['BASE_URL'] }}category">Quản lý Category</a></li>
        <li><a href="{{ $_ENV['BASE_URL'] }}product">Quản lý Product</a></li>
    </ul>
    
    <p><a href="{{ $_ENV['BASE_URL'] }}logout">Đăng xuất</a></p>
</body>
</html>