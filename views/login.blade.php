<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Đăng nhập</h1>
    
    @if (isset($_SESSION['errors']))
        <div class="error">
            @foreach ($_SESSION['errors'] as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @php unset($_SESSION['errors']) @endphp
    @endif
    
    <form action="{{ $_ENV['BASE_URL'] }}login" method="post">
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mật khẩu:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Đăng nhập</button>
        </div>
    </form>
</body>
</html>