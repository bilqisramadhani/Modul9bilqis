-- Jalankan ini dulu di phpMyAdmin
CREATE TABLE IF NOT EXISTS liga (
    kode CHAR(3) NOT NULL,
    negara CHAR(15),
    champion INT
);

INSERT INTO liga VALUES
('Jer', 'Jerman', 4),
('Spa', 'Spanyol', 3),
('Eng', 'English', 3);
