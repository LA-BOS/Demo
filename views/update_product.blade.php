<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật Product</title>
</head>
<body>
@if (isset($_SESSION['errors']))
        @foreach ($_SESSION['errors'] as $error)
            <h1>{{ $error }}</h1>
        @endforeach
        @php unset($_SESSION['errors']) @endphp
    @endif
    <form action="{{ $_ENV['BASE_URL'] }}admin/product/update/{{ $product['id'] }}" method="post" enctype="multipart/form-data">
        <label for="">Danh mục</label> <br>
        <select name="category_id" id="">
            @foreach ($categories as $value)
                <option 
                @if($product['category_id'] == $value['id'])
                    selected
                @endif
                value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
        </select> <br>
        <label for="">Tên sản phẩm</label> <br>
        <input type="text" name="name" value="{{$product['name']}}"> <br>
        <label for="">Ảnh sản phẩm</label> <br>
        @if ($product['img_thumbnail']!=null)
        <img src="{{$_ENV['BASE_URL'].$product['img_thumbnail']}}" style="width: 100px">
        @endif
        <br>
        <input type="file" name="img_thumbnail"> <br>
        <label for="">Mô tả</label> <br>
        <input type="text" name="description" value="{{$product['description']}}">> <br>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
