-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS ScortsDB;
USE ScortsDB;

-- Tabla Usuario (Base para Clientes y Scorts)
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL, -- Se recomienda encriptar la contraseña al insertarla
    rol ENUM('Cliente', 'Scort') NOT NULL, -- Puede ser 'Cliente' o 'Scort'
    genero ENUM('Masculino', 'Femenino', 'Otro') NOT NULL, -- Opciones de género
    telefono VARCHAR(15)
);

-- Tabla Cliente (Hereda de Usuario)
CREATE TABLE Cliente (
    id_cliente INT PRIMARY KEY,
    FOREIGN KEY (id_cliente) REFERENCES Usuario(id_usuario)
);

-- Tabla Scort (Hereda de Usuario)
CREATE TABLE Scort (
    id_scort INT PRIMARY KEY,
    alias VARCHAR(50) NOT NULL,
    ciudad VARCHAR(50),
    contacto VARCHAR(50),
    estatura DECIMAL(4, 2),
    peso DECIMAL(5, 2),
    medidas VARCHAR(50),
    imagen VARCHAR(255),
    FOREIGN KEY (id_scort) REFERENCES Usuario(id_usuario)
);

-- Tabla FormaPago
CREATE TABLE FormaPago (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    metodo_pago VARCHAR(50) NOT NULL
);

-- Tabla Cita
CREATE TABLE Cita (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2),
    estado_pago VARCHAR(50),
    estatus VARCHAR(50),
    no_transaccion VARCHAR(50),
    id_pago INT,
    testimonio1 TEXT,
    testimonio2 TEXT,
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente),
    FOREIGN KEY (id_pago) REFERENCES FormaPago(id_pago)
);

-- Tabla PreguntasFrecuentes
CREATE TABLE PreguntasFrecuentes (
    id_preguntas_frecuentes INT AUTO_INCREMENT PRIMARY KEY,
    pregunta VARCHAR(255) NOT NULL,
    respuesta TEXT NOT NULL
);

-- Tabla Contesta (Relación entre Scort y PreguntasFrecuentes)
CREATE TABLE Contesta (
    id_preguntas_frecuentes INT,
    id_scort INT,
    PRIMARY KEY (id_preguntas_frecuentes, id_scort),
    FOREIGN KEY (id_preguntas_frecuentes) REFERENCES PreguntasFrecuentes(id_preguntas_frecuentes),
    FOREIGN KEY (id_scort) REFERENCES Scort(id_scort)
);
