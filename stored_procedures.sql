-- ============================================
-- STORED PROCEDURE TUGAS RUMAH - TABEL BUKU
-- Jalankan satu per satu di phpMyAdmin
-- ============================================

-- Pastikan pakai database yang benar
USE praktikum_buku;

-- ============================================
-- SOAL 1: Cek ketersediaan buku
-- ============================================
DROP PROCEDURE IF EXISTS CekBuku;
DELIMITER //
CREATE PROCEDURE CekBuku(IN p_id_buku INT, OUT status VARCHAR(20))
BEGIN
    DECLARE stok_buku INT DEFAULT 0;
    SELECT stok INTO stok_buku FROM detail_buku WHERE id_buku = p_id_buku;
    IF stok_buku > 0 THEN
        SET status = 'BUKU TERSEDIA';
    ELSE
        SET status = 'BUKU SEDANG KOSONG';
    END IF;
END //
DELIMITER ;

-- Eksekusi Soal 1:
CALL CekBuku(102, @status);
SELECT @status;

-- ============================================
-- SOAL 2: Tambah data penulis
-- ============================================
DROP PROCEDURE IF EXISTS TambahPenulis;
DELIMITER //
CREATE PROCEDURE TambahPenulis(IN p_id INT, IN p_nama VARCHAR(100))
BEGIN
    INSERT INTO penulis (id_penulis, nama_penulis) VALUES (p_id, p_nama);
END //
DELIMITER ;

-- Eksekusi Soal 2:
CALL TambahPenulis(200, 'Tere Liye');
SELECT * FROM penulis;

-- ============================================
-- SOAL 3: Jumlah buku genre Romance
-- ============================================
DROP PROCEDURE IF EXISTS JumlahRomance;
DELIMITER //
CREATE PROCEDURE JumlahRomance(OUT total INT)
BEGIN
    SELECT COUNT(*) INTO total FROM buku WHERE genre = 'Romance';
END //
DELIMITER ;

-- Eksekusi Soal 3:
CALL JumlahRomance(@total);
SELECT @total;
