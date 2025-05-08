# Shop Thời Trang Viruss

## Giới thiệu
**Shop Thời Trang Viruss** là một website thương mại điện tử được xây dựng nhằm cung cấp nền tảng mua sắm trực tuyến cho người dùng. Website cho phép người dùng duyệt sản phẩm, tìm kiếm, thêm vào giỏ hàng, đặt hàng và quản lý tài khoản cá nhân. Đây là một đồ án nhóm được thực hiện với mục tiêu học tập và thực hành các kỹ năng lập trình web.

## Tính năng chính
- **Trang chủ**: Hiển thị danh sách sản phẩm nổi bật và các danh mục.
- **Tìm kiếm sản phẩm**: Cho phép người dùng tìm kiếm sản phẩm theo từ khóa.
- **Giỏ hàng**: Quản lý các sản phẩm đã thêm vào giỏ hàng.
- **Đặt hàng**: Xem và quản lý các đơn hàng đã đặt.
- **Quản lý tài khoản**: Đăng nhập, đăng ký, và đăng xuất tài khoản người dùng.
- **Giao diện thân thiện**: Thiết kế giao diện hiện đại, dễ sử dụng.

## Công nghệ sử dụng
- **Backend**: Laravel Framework (PHP)
- **Frontend**: Blade Template Engine, HTML, CSS, Bootstrap, Font Awesome
- **Cơ sở dữ liệu**: MySQL
- **Thư viện và công cụ**:
  - Bootstrap 5.3.3
  - Font Awesome 6.4.0
  - Google Fonts
  - Slick Slider

## Cấu trúc dự án
- **resources/views/user**: Chứa các file giao diện người dùng, bao gồm `dashboard_user.blade.php` để hiển thị trang dashboard của người dùng.
- **routes/web.php**: Định nghĩa các route cho ứng dụng.
- **public/css**: Chứa các file CSS tùy chỉnh.
- **public/js**: Chứa các file JavaScript.

## Hướng dẫn cài đặt
1. Clone repository:
   ```bash
   git clone https://github.com/your-repo/shop-thoi-trang-viruss.git
   cd shop-thoi-trang-viruss
2. Cài đặt các gói phụ thuộc:
 ```bash
   composer install
   npm install
```
3. Tạo file `.env` từ file `.env.example` và cấu hình kết nối cơ sở dữ liệu:
   ```bash
   cp .env.example .env
   Cập nhật thông tin kết nối cơ sở dữ liệu trong file .env:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=shop_thoi_trang
   DB_USERNAME=root
   DB_PASSWORD=
4. Chạy lệnh migrate để tạo bảng trong cơ sở dữ liệu:
   ```bash
   php artisan migrate
5. Chạy lệnh seeder để thêm dữ liệu mẫu vào cơ sở dữ liệu:
   ```bash
   php artisan db:seed
6. Build các file Frontend:
   ```bash
   npm run dev
7. Chạy ứng dụng:
   ```bash
   php artisan serve
8. Truy cập vào địa chỉ `http://localhost:8000` để xem ứng dụng.

Đóng góp
Nếu bạn muốn đóng góp cho dự án, vui lòng tạo một pull request hoặc mở issue để thảo luận.

Liên hệ
Email: haducluong129Gmail.com
Facebook: [Hà Đức Lương](https://www.facebook.com/haducluong.it)
Địa chỉ: Thành phố Thủ Đức, TP.HCM, Việt Nam

