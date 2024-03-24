// CREATE TABLE Loai (
//     MaLoai VARCHAR(255) PRIMARY KEY,
//     TenLoai VARCHAR(255)
// );

// CREATE TABLE XuatXu (
//     MaXX VARCHAR(255) PRIMARY KEY,
//     TenNuoc VARCHAR(255)
// );
// CREATE TABLE Size (
//     MaSize varchar(20) PRIMARY KEY,
//     KichThuoc VARCHAR(255)

// );
// CREATE TABLE MauSac (
//     MaMau VARCHAR(255) PRIMARY KEY,
//     TenMau VARCHAR(255)
// );

// CREATE TABLE ThuongHieu (
//     MaThuongHieu VARCHAR(255) PRIMARY KEY,
//     TenThuongHieu VARCHAR(255),
//     DiaChi VARCHAR(255),
//     Email VARCHAR(255)
// );

// CREATE TABLE Giay (
//     MaGiay VARCHAR(255) PRIMARY KEY,
//     Tengia VARCHAR(50),
//     SoLuong INT,
//     DonGia DECIMAL(10,2), -- Giả sử DonGia là kiểu số thập phân, 2 số sau dấu phẩy
//     Masize VARCHAR(20),
//     DoiTuongSuDung VARCHAR(100),
//     ChatLieu VARCHAR(50),
//     MaLoai VARCHAR(255), -- Cột khóa ngoại đến bảng Loai
//     MaXX VARCHAR(255), -- Cột khóa ngoại đến bảng XuatXu (giả sử)
//     MaMau VARCHAR(255), -- Cột khóa ngoại đến bảng MauSac (giả sử)
//     MaThuongHieu VARCHAR(255),
//     HinhAnh varchar(255),
// 	 FOREIGN KEY (MaLoai) REFERENCES Loai(MaLoai),
//     FOREIGN KEY (MaXX) REFERENCES XuatXu(MaXX),
//     FOREIGN KEY (Masize) REFERENCES Size(MaSize),
//     FOREIGN KEY (MaMau) REFERENCES MauSac(MaMau),
//     FOREIGN KEY (MaThuongHieu) REFERENCES ThuongHieu(MaThuongHieu)-- Cột khóa ngoại đến bảng ThuongHieu (giả sử)
// );
// CREATE TABLE ChuongTrinhKhuyenMai (
//     MaKM VARCHAR(255) PRIMARY KEY,
//     NgayBatDau DATE,
//     NgayKetThuc DATE,
//     TenChuongTrinh VARCHAR(255),
//     LoaiChuongTrinh VARCHAR(255),
//     DieuKien VARCHAR(255)
// );

// CREATE TABLE ChitietChuongTrinhKhuyenMai (
//     MaKM VARCHAR(255),
//     MaGiay VARCHAR(255),
//     TiLeKMTheo DECIMAL(5,2), -- Ví dụ: 5.2%
//         PRIMARY KEY (MaKM, MaGiay),
//     FOREIGN KEY (MaKM) REFERENCES ChuongTrinhKhuyenMai(MaKM),
//     FOREIGN KEY (MaGiay) REFERENCES Giay(MaGiay)

// );

// CREATE TABLE NhaCungCap (
//     MaNCC varchar(255) PRIMARY KEY,
//     TenNCC VARCHAR(255),
//     DiaChi VARCHAR(255),
//     DienThoai VARCHAR(20)
// );

// CREATE TABLE KhachHang (
//     MaKH varchar(255) PRIMARY KEY,
//     Loai VARCHAR(50),
//     TongChiTieu DECIMAL(10,2),
//     Ho VARCHAR(50),
//     Ten VARCHAR(50),
//     GioiTinh VARCHAR(10),
//     DiaChi VARCHAR(255),
//     Email VARCHAR(255)
// );

// CREATE TABLE NhanVien (
//     MaNV varchar(255) PRIMARY KEY,
//     ChucVu VARCHAR(255),
//     Ho VARCHAR(50),
//     Ten VARCHAR(50),
//     GioiTinh VARCHAR(10),
//     DiaChi VARCHAR(255),
//     DienThoai VARCHAR(20),
//     Email VARCHAR(255),
//     Luong DECIMAL(10,2)
// );

// CREATE TABLE PhieuNhap (
//     MaPN varchar(255) PRIMARY KEY,
//     NgayNhap DATE,
//     TongTien DECIMAL(10,2),
//     MaNV varchar(255),
//     MaNCC varchar(255),
//     FOREIGN KEY (MaNV) REFERENCES NhanVien(MaNV),
//     FOREIGN KEY (MaNCC) REFERENCES NhaCungCap(MaNCC)
// );

// CREATE TABLE TaiKhoan (
//     MaNV varchar(255) PRIMARY KEY,
//     MaKhau VARCHAR(255),
//     CapBac INT,
//     FOREIGN KEY (MaNV) REFERENCES NhanVien(MaNV) -- Giả sử MaNV là khóa ngoại tham chiếu đến bảng NhanVien
// );

// CREATE TABLE ChiTietPhieuNhap (
//     MaGiay VARCHAR(255) ,
//     MaPN varchar(255) ,
//     SoLuong INT,
//     GiaNhap DECIMAL(10,2),
//         PRIMARY KEY (MaGiay, MaPN),
//     FOREIGN KEY (MaPN) REFERENCES PhieuNhap(MaPN),
//     FOREIGN KEY (MaGiay) REFERENCES Giay(MaGiay)

// );

// CREATE TABLE HoaDon (
//     MaHD varchar(255) PRIMARY KEY,
//     MaNV varchar(255),
//     MaKM varchar(255),
//     MaKH varchar(255),
//     NgayBan DATE,
//     TongTien DECIMAL(10,2),
//     Thue DECIMAL(10,2),
//     FOREIGN KEY (MaNV) REFERENCES NhanVien(MaNV),
//     FOREIGN KEY (MaKM) REFERENCES ChuongTrinhKhuyenMai(MaKM),
//     FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH)
// );

// CREATE TABLE ChiTietHoaDon (
//     MaGiay VARCHAR(255),
//     MaHD varchar(255),
//     SoLuong varchar(255),
//     GiaBan DECIMAL(10,2),
//     PRIMARY KEY (MaGiay, MaHD),
//     FOREIGN KEY (MaHD) REFERENCES HoaDon(MaHD),
//     FOREIGN KEY (MaGiay) REFERENCES Giay(MaGiay)

// );
