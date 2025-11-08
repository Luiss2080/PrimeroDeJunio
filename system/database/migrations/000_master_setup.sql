-- Migracion: 000_master_setup.sql
-- Configuracion inicial de la base de datos

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS primero_de_junio CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

-- Usar la base de datos
USE primero_de_junio;

-- Configurar el motor de base de datos
SET default_storage_engine = InnoDB;
SET foreign_key_checks = 1;

-- Configurar timezone
SET time_zone = '-05:00'; -- Colombia timezone