-- ============================================================
-- Animalia - Base de datos
-- Importar desde phpMyAdmin: pestaña "Importar" > seleccionar este archivo
-- ============================================================

CREATE DATABASE IF NOT EXISTS animalia
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE animalia;

-- ------------------------------------------------------------
-- Tabla de usuarios
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabla de veterinarias (datos ficticios)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS veterinarias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  ciudad VARCHAR(80) NOT NULL,
  direccion VARCHAR(150) NOT NULL,
  telefono VARCHAR(30) NOT NULL,
  especialidad VARCHAR(120) NOT NULL,
  descripcion TEXT,
  calificacion DECIMAL(2,1) NOT NULL DEFAULT 0.0,
  total_resenas INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO veterinarias
  (nombre, ciudad, direccion, telefono, especialidad, descripcion, calificacion, total_resenas)
VALUES
  ('Patitas Felices', 'Bogotá', 'Cra 15 # 85-20', '601 555 0101',
   'Medicina general y vacunación',
   'Clínica con más de 10 años cuidando a perros y gatos con mucho cariño.', 4.9, 328),

  ('Huellitas Vet', 'Medellín', 'Calle 10 # 40-12', '604 555 0102',
   'Cirugía y urgencias 24 horas',
   'Equipo de urgencias disponible todos los días del año.', 4.8, 291),

  ('Mundo Animal Center', 'Cali', 'Av 6N # 23-45', '602 555 0103',
   'Exóticos y aves',
   'Especialistas en aves, reptiles y pequeños mamíferos.', 4.7, 214),

  ('Pelaje & Colita', 'San Gil', 'Calle 12 # 8-30', '607 555 0104',
   'Peluquería y spa canino',
   'Baño, corte y spa para que tu mascota luzca increíble.', 4.6, 187),

  ('Clínica Veterinaria Amigos Fieles', 'Bucaramanga', 'Cra 27 # 36-10', '607 555 0105',
   'Odontología y dermatología',
   'Diagnóstico moderno y tratamientos personalizados.', 4.5, 163),

  ('Vet Salvaje', 'Barranquilla', 'Calle 84 # 51-18', '605 555 0106',
   'Ortopedia y rehabilitación',
   'Fisioterapia y rehabilitación para mascotas en recuperación.', 4.4, 142);
