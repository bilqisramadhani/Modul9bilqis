-- Jalankan di phpMyAdmin dulu
CREATE TABLE IF NOT EXISTS jurusan (
    ID_Jur INT PRIMARY KEY AUTO_INCREMENT,
    Nama VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS mahasiswa (
    NRP VARCHAR(20) PRIMARY KEY,
    Nama VARCHAR(50),
    Alamat VARCHAR(100),
    Foto VARCHAR(100),
    ID_Jur INT,
    FOREIGN KEY (ID_Jur) REFERENCES jurusan(ID_Jur)
);

-- Insert data jurusan
INSERT INTO jurusan (Nama) VALUES
('Telekomunikasi'),
('Elka'),
('IT'),
('Elin');
