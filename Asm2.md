## Sử dụng mô hình MVC - OOP (library cần thiết)

**Yêu cầu thư viện trong dự án (bắt buộc)**

- **bramus/router**: Định tuyến
- **doctrine/dbal**: Kết nối + truy vấn PHP và MYSQL
- **vlucas/phpdotenv**: Cấu hình biến môi trường trong PHP

**Yêu cầu thư viện trong dự án (không bắt buộc - nhưng có thì điểm cao hơn 😀)**

- **rakit/validation**: Validate dữ liệu đầu vào
- **eftec/bladeone**: template engine dành cho PHP

**Đề bài:**
Xây dựng một dự án quản lý website nhỏ. Lớp cần chuẩn bị một giao diện Admin cho bài toán này (sử dụng bladeone để cắt giao diện)
**_Chú ý: Không cần giao diện người dùng, chỉ cần giao diện quản lý của admin_**

Lớp tự định nghĩa các trường dữ liệu và tạo database cho các bảng sau

1. Bảng User (người dùng)
2. Bảng Category (danh mục sản phẩm)
3. Bảng Product (sản phẩm)

**Yêu cầu chính**
**_1. Định tuyến đúng prefix_**

```php
// Ví dụ: Các đường dẫn CRUD cho bảng user
// http://localhost:8080/WD19315/B12/user/
// http://localhost:8080/WD19315/B12/user/add
// http://localhost:8080/WD19315/B12/user/update
// ...
// Các đường dẫn CRUD cho bảng product
// http://localhost:8080/WD19315/B12/product/
// http://localhost:8080/WD19315/B12/product/add
// http://localhost:8080/WD19315/B12/product/update
// ...
```

**_2. Xây dựng chức năng đăng nhập_**

- Nếu đăng nhập (email + password) với tài khoản user có role "admin" thì được truy cập website admin. Nếu không không cho truy cập
- Khi đăng nhập nếu có lỗi, phải thông báo lại giao diện cho người dùng (lưu thông báo vào SESSION)

**_3. Xây dựng Middleware cho router_**

- Nếu đã đăng nhập và có role admin, lưu giữ trạng thái đăng nhập đó vào SESSION
- Viết middleware cho các route, nếu có SESSION thì cho truy cập các route admin, không có bắt đăng nhập lại

**_4. CRUD(đây là yêu cầu tối thiểu phải làm được)_**

- Sử dụng đúng mô hình MVC để CRUD cho 3 bảng trên
- Chú ý: Bảng product được kết nối khóa ngoại với bảng Category

**_5. Validate_**

- Đối với hoạt động CRUD phải có validate, tùy thuộc vào kiểu dữ liệu của các trường trong từng Bảng
- Khuyến khích sử dụng thư viện _rakit/validation_ hơn là if..else
- Thông báo lỗi: Nếu không qua được validate, lưu thông báo vào SESSION trả lại và hiển thị nó bên view cho người dùng

**_6. Xây dựng chức năng tìm kiếm theo tên_**

- Trong phần hiển thị danh sách của từng bảng (User, Category, Product) có một ô input nhập tên
- Sau khi nhập tên, viết câu lệnh truy vấn và hiển thị thông tin dữ liệu theo kết quả đã tìm kiếm đó
