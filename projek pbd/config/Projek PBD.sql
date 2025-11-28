create database Projek_PBD;
use Projek_PBD;

create table satuan (
    idsatuan int primary key,
    nama_satuan varchar(45) not null,
    status tinyint
);

describe satuan;

create table vendor (
    idvendor int primary key,
    nama_vendor varchar(100) not null,
    badan_hukum char(1),
    status char(1)
);

describe vendor;

create table barang (
    idbarang int primary key,
    jenis char(1),
    nama varchar(45) not null,
    idsatuan int,
    status tinyint,
    created_at timestamp default current_timestamp,
    foreign key (idsatuan) references satuan(idsatuan)
);

describe barang;

create table role (
    idrole int primary key,
    nama_role varchar(50) not null
);

describe role;

create table user (
    iduser int primary key,
    username varchar(50) not null unique,
    password varchar(100) not null,
    nama_lengkap varchar(100) not null,
    idrole int,
    status char(1),
    foreign key (idrole) references role(idrole)
);

describe user;

create table pengadaan (
    idpengadaan int primary key,
    idvendor int not null,
    iduser int not null,
    tanggal date not null,
    status char(1),
    foreign key (idvendor) references vendor(idvendor),
    foreign key (iduser) references user(iduser)
);

describe pengadaan;

create table detail_pengadaan (
    iddetail_pengadaan int primary key,
    idpengadaan int not null,
    idbarang int not null,
    jumlah int not null,
    harga decimal(12,2) not null,
    foreign key (idpengadaan) references pengadaan(idpengadaan),
    foreign key (idbarang) references barang(idbarang)
);

describe detail_pengadaan;

create table penerimaan (
    idpenerimaan int primary key,
    idpengadaan int not null,
    tanggal date not null,
    iduser int not null,
    status char(1),
    foreign key (idpengadaan) references pengadaan(idpengadaan),
    foreign key (iduser) references user(iduser)
);

describe penerimaan;

create table detail_penerimaan (
    iddetail_penerimaan int primary key,
    idpenerimaan int not null,
    idbarang int not null,
    jumlah int not null,
    kondisi varchar(50),
    foreign key (idpenerimaan) references penerimaan(idpenerimaan),
    foreign key (idbarang) references barang(idbarang)
);

describe detail_penerimaan;

create table retur (
    idretur int primary key, idpenerimaan int not null,
    tanggal date not null, iduser int not null,
    alasan varchar(100),
    status char(1),
    foreign key (idpenerimaan) references penerimaan(idpenerimaan),
    foreign key (iduser) references user(iduser)
);

describe retur;

create table detail_retur (
    iddetail_retur int primary key,
    idretur int not null,
    iddetail_penerimaan int not null,
    jumlah int not null,
    alasan varchar(200),
    foreign key (idretur) references retur(idretur),
    foreign key (iddetail_penerimaan) references detail_penerimaan(iddetail_penerimaan)
);

describe detail_retur;

create table penjualan (
    idpenjualan int primary key,
    tanggal date not null,
    iduser int not null,
    subtotal int,
    ppn int,
    total int,
    status char(1),
    foreign key (iduser) references user(iduser)
);

describe penjualan;

create table detail_penjualan (
    iddetail_penjualan int primary key,
    idpenjualan int not null,
    idbarang int not null,
    jumlah int not null,
    harga_satuan int not null,
    subtotal int not null,
    foreign key (idpenjualan) references penjualan(idpenjualan),
    foreign key (idbarang) references barang(idbarang)
);

describe detail_penjualan;

create table kartu_stok (
    idkartu_stok int primary key,
    idbarang int not null,
    tanggal date not null,
    jenis_transaksi varchar(20),
    jumlah int not null,
    keterangan varchar(100),
    foreign key (idbarang) references barang(idbarang)
);

describe kartu_stok;

create table margin_penjualan (
    idmargin int primary key,
    idbarang int not null,
    persentase decimal(5,2) not null,
    tanggal_berlaku date not null,
    foreign key (idbarang) references barang(idbarang)
);

describe margin_penjualan;

insert into satuan (idsatuan, nama_satuan, status) values
(1, 'pcs', 1),
(2, 'dus', 1),
(3, 'pack', 1),
(4, 'kg', 1),
(5, 'ltr', 1);

select * from satuan;

insert into vendor (idvendor, nama_vendor, badan_hukum, status) values
(1, 'pt sumber makmur', 'y', 'a'),
(2, 'cv sejahtera abadi', 'y', 'a'),
(3, 'toko bintang terang', 't', 'a'),
(4, 'ud cahaya baru', 't', 'n'),
(5, 'pt indo supplies', 'y', 'a');

select * from vendor;

insert into barang (idbarang, jenis, nama, idsatuan, status) values
(1, 'b', 'beras 5kg', 4, 1),
(2, 'b', 'minyak goreng 1ltr', 5, 1),
(3, 'a', 'sendok makan', 1, 1),
(4, 'a', 'piring keramik', 1, 1),
(5, 'b', 'mie instan', 3, 1);

select * from barang;

insert into role (idrole, nama_role) values
(1, 'Admin'),
(2, 'Superadmin');

select * from role;

insert into user (iduser, username, password, nama_lengkap, idrole) values
(1, 'admin', 'admin123', 'Administrator', 1),
(2, 'superadmin', 'super123', 'Super Administrator', 2),
(3, 'budi', 'budi123', 'Budi Santoso', 1),
(4, 'sari', 'sari123', 'Sari Dewi', 1),
(5, 'andi', 'andi123', 'Andi Wijaya', 1);

select * from user;

CREATE VIEW view_barang AS
SELECT 
    b.idbarang,
    b.nama AS nama_barang,
    b.jenis,
    s.nama_satuan,
    b.status
FROM barang b
JOIN satuan s ON b.idsatuan = s.idsatuan;

CREATE VIEW view_barang_pengadaan AS
SELECT 
    b.idbarang,
    b.nama AS nama_barang,
    v.nama_vendor,
    p.idpengadaan,
    dp.jumlah,
    dp.harga
FROM barang b
JOIN detail_pengadaan dp ON b.idbarang = dp.idbarang
JOIN pengadaan p ON dp.idpengadaan = p.idpengadaan
JOIN vendor v ON p.idvendor = v.idvendor;

CREATE VIEW view_barang_penjualan AS
SELECT 
    b.idbarang,
    b.nama AS nama_barang,
    dp.jumlah,
    dp.harga_satuan,
    dp.subtotal
FROM barang b
JOIN detail_penjualan dp ON b.idbarang = dp.idbarang;

CREATE VIEW view_pengadaan AS
SELECT 
    p.idpengadaan,
    v.nama_vendor,
    p.tanggal,
    p.status
FROM pengadaan p
JOIN vendor v ON p.idvendor = v.idvendor;

CREATE VIEW view_detail_pengadaan AS
SELECT 
    dp.iddetail_pengadaan,
    p.idpengadaan,
    b.nama AS nama_barang,
    dp.jumlah,
    dp.harga,
    (dp.jumlah * dp.harga) AS total
FROM detail_pengadaan dp
JOIN barang b ON dp.idbarang = b.idbarang
JOIN pengadaan p ON dp.idpengadaan = p.idpengadaan;

CREATE VIEW view_penerimaan AS
SELECT 
    p.idpenerimaan,
    pg.idpengadaan,
    u.nama_lengkap AS diterima_oleh,
    p.tanggal,
    p.status
FROM penerimaan p
JOIN pengadaan pg ON p.idpengadaan = pg.idpengadaan
JOIN user u ON p.iduser = u.iduser;

CREATE VIEW view_detail_penerimaan AS
SELECT 
    dp.iddetail_penerimaan,
    p.idpenerimaan,
    b.nama AS nama_barang,
    dp.jumlah,
    dp.kondisi
FROM detail_penerimaan dp
JOIN barang b ON dp.idbarang = b.idbarang
JOIN penerimaan p ON dp.idpenerimaan = p.idpenerimaan;

CREATE VIEW view_detail_penjualan AS
SELECT 
    dp.iddetail_penjualan,
    p.idpenjualan,
    b.nama AS nama_barang,
    dp.jumlah,
    dp.harga_satuan,
    dp.subtotal
FROM detail_penjualan dp
JOIN barang b ON dp.idbarang = b.idbarang
JOIN penjualan p ON dp.idpenjualan = p.idpenjualan;

CREATE VIEW view_user_role AS
SELECT 
    u.iduser,
    u.username,
    u.nama_lengkap,
    r.nama_role,
    u.status
FROM user u
JOIN role r ON u.idrole = r.idrole;

CREATE VIEW view_kartu_stok AS
SELECT 
    k.idkartu_stok,
    b.nama AS nama_barang,
    k.tanggal,
    k.jenis_transaksi,
    k.jumlah,
    k.keterangan
FROM kartu_stok k
JOIN barang b ON k.idbarang = b.idbarang;

DELIMITER //
CREATE PROCEDURE sp_tambah_vendor(
    IN p_nama_vendor VARCHAR(100),
    IN p_badan_hukum CHAR(1),
    IN p_status CHAR(1)
)
BEGIN
    INSERT INTO vendor (nama_vendor, badan_hukum, status)
    VALUES (p_nama_vendor, p_badan_hukum, p_status);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_tambah_pengadaan(
    IN p_idvendor INT,
    IN p_tanggal DATE,
    IN p_status CHAR(1)
)
BEGIN
    INSERT INTO pengadaan (idvendor, tanggal, status)
    VALUES (p_idvendor, p_tanggal, p_status);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_tambah_penjualan(
    IN p_iduser INT,
    IN p_tanggal DATE,
    IN p_total DECIMAL(12,2),
    IN p_status CHAR(1)
)
BEGIN
    INSERT INTO penjualan (iduser, tanggal, total, status)
    VALUES (p_iduser, p_tanggal, p_total, p_status);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_update_status_pengadaan(
    IN p_idpengadaan INT,
    IN p_status CHAR(1)
)
BEGIN
    UPDATE pengadaan
    SET status = p_status
    WHERE idpengadaan = p_idpengadaan;
END //
DELIMITER ;

DELIMITER //
CREATE FUNCTION fn_hitung_total(
    jumlah INT,
    harga DECIMAL(12,2)
)
RETURNS DECIMAL(12,2)
DETERMINISTIC
BEGIN
    RETURN jumlah * harga;
END //
DELIMITER ;

DELIMITER //
CREATE FUNCTION fn_hitung_diskon(
    total DECIMAL(12,2)
)
RETURNS DECIMAL(12,2)
DETERMINISTIC
BEGIN
    RETURN total - (total * 0.10);
END //
DELIMITER ;

DELIMITER //
CREATE FUNCTION fn_hitung_ppn(
    total DECIMAL(12,2)
)
RETURNS DECIMAL(12,2)
DETERMINISTIC
BEGIN
    RETURN total + (total * 0.11);
END //
DELIMITER ;

SELECT * FROM view_barang;

CALL sp_tambah_vendor('CV Cahaya Abadi', 'Y', 'A');
SELECT * FROM vendor;

SELECT fn_hitung_total(6, 13000);
SHOW CREATE FUNCTION fn_hitung_total;

DROP PROCEDURE IF EXISTS sp_tambah_vendor;
DROP PROCEDURE IF EXISTS sp_tambah_pengadaan;
DROP PROCEDURE IF EXISTS sp_tambah_penjualan;
DROP PROCEDURE IF EXISTS sp_update_status_pengadaan;

DELIMITER //
CREATE PROCEDURE sp_barang_status(IN p_status TINYINT)
BEGIN
    SELECT idbarang, nama, idsatuan, status
    FROM barang
    WHERE status = p_status;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_detail_penjualan(IN p_idpenjualan INT)
BEGIN
    SELECT dp.idpenjualan,
           b.nama AS nama_barang,
           dp.jumlah,
           dp.harga_satuan,
           dp.subtotal
    FROM detail_penjualan dp
    JOIN barang b ON dp.idbarang = b.idbarang
    WHERE dp.idpenjualan = p_idpenjualan;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_detail_pengadaan(IN p_idpengadaan INT)
BEGIN
    SELECT dp.idpengadaan,
           b.nama AS nama_barang,
           dp.jumlah,
           dp.harga,
           (dp.jumlah * dp.harga) AS total
    FROM detail_pengadaan dp
    JOIN barang b ON dp.idbarang = b.idbarang
    WHERE dp.idpengadaan = p_idpengadaan;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_detail_penerimaan(IN p_idpenerimaan INT)
BEGIN
    SELECT dp.idpenerimaan,
           b.nama AS nama_barang,
           dp.jumlah,
           dp.kondisi
    FROM detail_penerimaan dp
    JOIN barang b ON dp.idbarang = b.idbarang
    WHERE dp.idpenerimaan = p_idpenerimaan;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_user_role()
BEGIN
    SELECT u.iduser,
           u.username,
           u.nama_lengkap,
           r.nama_role,
           u.status
    FROM user u
    JOIN role r ON u.idrole = r.idrole;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER trg_after_penerimaan
AFTER INSERT ON detail_penerimaan
FOR EACH ROW
BEGIN
    UPDATE barang
    SET status = 1
    WHERE idbarang = NEW.idbarang;

    INSERT INTO kartu_stok (idkartu_stok, idbarang, tanggal, jenis_transaksi, jumlah, keterangan)
    VALUES (NEW.iddetail_penerimaan, NEW.idbarang, CURDATE(), 'Penerimaan', NEW.jumlah, 'Barang diterima');
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER trg_after_penjualan
AFTER INSERT ON detail_penjualan
FOR EACH ROW
BEGIN
    UPDATE barang
    SET status = 0
    WHERE idbarang = NEW.idbarang;

    INSERT INTO kartu_stok (idkartu_stok, idbarang, tanggal, jenis_transaksi, jumlah, keterangan)
    VALUES (NEW.iddetail_penjualan, NEW.idbarang, CURDATE(), 'Penjualan', NEW.jumlah, 'Barang terjual');
END //
DELIMITER ;

 ALTER TABLE barang ADD stok INT DEFAULT 0 AFTER idsatuan;
 
 DESCRIBE barang;
 
 ALTER TABLE barang ADD harga DECIMAL(12,2) DEFAULT 0 AFTER stok;

SELECT * FROM barang;

ALTER TABLE barang
  MODIFY idbarang INT NOT NULL AUTO_INCREMENT;

SET FOREIGN_KEY_CHECKS = 0;
ALTER TABLE barang MODIFY idbarang INT NOT NULL AUTO_INCREMENT;
SET FOREIGN_KEY_CHECKS = 1;

ALTER TABLE barang AUTO_INCREMENT = 6;

