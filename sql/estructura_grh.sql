/*Este es el query para crear GRH*/
desc usuarios;
CREATE DATABASE grh_db CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
create USER 'grh_god'@'localhost' IDENTIFIED BY 'God_G*7';
GRANT SELECT, DELETE, UPDATE, CREATE, INSERT ON grh_db.* TO 'grh_god'@'localhost';

ALTER USER 'grh_god'@'localhost' IDENTIFIED BY 'Grh_1';

use grh_db;

CREATE TABLE usuarios (
	num_usuario int(8) NOT NULL UNIQUE auto_increment,
    PRIMARY KEY (num_usuario),
    correo CHAR(40) NOT NULL UNIQUE,
    nombre_user char(40) not null,
    numero char(10) not null,
    rfc char(13),
    pase char(100) not null
)CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE actividades(
	num_actividad int(8) NOT NULL UNIQUE auto_increment,
    PRIMARY KEY(num_actividad),
    nombre_act char(30) NOT NULL
)CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE empleadores(
	num_emp int(8) NOT NULL UNIQUE auto_increment,
    PRIMARY KEY(num_emp),
    num_usuario int(8) NOT NULL,
    nombre_emp CHAR(40) NOT NULL,
    nombre_emp_emp VARCHAR(50), 
    correo_emp char(40),
    tel_emp char(10),
    num_empleado char(20),
    rfc_emp char(13),
    FOREIGN KEY (num_usuario) REFERENCES usuarios(num_usuario)
)CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

CREATE TABLE calculos(
	num_cal int(10) NOT NULL UNIQUE auto_increment,
    num_usuario int(8) NOT NULL,
    num_emp int(8) NOT NULL,
    num_actividad int(8) NOT NULL,
    fecha date,
    hora_ent TIME,
    hora_sal TIME,
    horas_tra INT,
    descripcion varchar(150),
    transporte int,
    total int,
    estado boolean,
    /* relaciones */
    PRIMARY KEY(num_cal),
    FOREIGN KEY(num_usuario) REFERENCES usuarios(num_usuario),
    FOREIGN KEY(num_emp) REFERENCES empleadores(num_emp),
    FOREIGN KEY(num_actividad) REFERENCES actividades(num_actividad)
)CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

truncate table usuarios;