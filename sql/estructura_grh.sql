/*Este es el query para crear GRH*/

CREATE DATABASE grh_db;
create USER 'grh_god' IDENTIFIED BY 'God_G*7';
GRANT SELECT, DELETE, UPDATE, CREATE ON grh_db.* TO grh_god;

use grh_db;

CREATE TABLE usuarios(
	num_usuario CHAR(8) NOT NULL UNIQUE,
    PRIMARY KEY (num_usuario),
    nombre_user char(40) not null,
    correo CHAR(40) NOT NULL UNIQUE
);

CREATE TABLE actividades(
	num_actividad char(8) NOT NULL UNIQUE,
    PRIMARY KEY(num_actividad),
    nombre_act char(30) NOT NULL
);

CREATE TABLE empleadores(
	num_emp char(8) NOT NULL UNIQUE,
    PRIMARY KEY(num_emp),
    nombre_emp CHAR(40) NOT NULL
);

CREATE TABLE calculos(
	num_cal CHAR(9) NOT NULL UNIQUE,
    num_usuario CHAR(8) NOT NULL,
    num_emp char(8) NOT NULL,
    num_actividad char(8) NOT NULL,
    fecha date,
    hora_ent TIME,
    hora_sal TIME,
    horas_tra INT,
    descripcion varchar(150),
    transporte int,
    total int,
    estado boolean,
    
    PRIMARY KEY(num_cal),
    FOREIGN KEY(num_usuario) REFERENCES usuarios(num_usuario),
    FOREIGN KEY(num_emp) REFERENCES empleadores(num_emp),
    FOREIGN KEY(num_actividad) REFERENCES actividades(num_actividad)
);
