use grh_db;
select * from usuarios;
select correo, nombre_user from usuarios where correo = 'abelardo@mail.com';
SELECT pase, nombre_user FROM usuarios WHERE correo = 'abelardo@mail.com';

SELECT nombre_user, numero, rfc, num_empleado, pase FROM usuarios WHERE correo = 'abelardo@mail.com';

UPDATE usuarios SET numero = '5514917662', num_empleado = '123456', rfc='1234567890123'	where correo = 'abelardo@mail.com';
desc usuarios;

INSERT INTO empleadores(num_usuario,nombre_emp,nombre_emp_emp,correo_emp,tel_emp,num_empleado,rfc_emp) VALUES ('numUsuario','NOMBRE','nombreEmpresa','correo','telefono','numEmpelado','rfc');
INSERT INTO empleadores(num_usuario,nombre_emp,nombre_emp_emp,correo_emp,tel_emp,num_empleado,rfc_emp) VALUES ('1','NOMBRE','nombreEmpresa','correo','telefono','numEmpelado','rfc');
update empleadores set cuota = '100' WHERE num_usuario='1' and nombre_emp='Alfredo GutiÃ©rrez';/*Editar por empleador*/
SELECT nombre_emp,nombre_emp_emp, tel_emp FROM empleadores WHERE num_usuario = '1' order by nombre_emp ;
select * from empleadores;
SELECT num_usuario from usuarios WHERE correo = 'abelardo@mail.com';

SELECT nombre_emp, nombre_emp_emp, correo_emp, tel_emp, num_empleado, rfc_emp, cuota FROM empleadores WHERE num_emp='1' and num_usuario='1';
UPDATE empleadores SET nombre_emp = 'Carlos Enrique Sosa', nombre_emp_emp = 'Instituto Curltural Columbia', correo_emp = 'columbiacel@hotmail.com',
tel_emp = '5522331166', num_empleado='T01', rfc_emp='', cuota='80' WHERE nombre_emp = 'Carlos Sosa' and num_usuario='1';

SELECT calculos.num_cal, calculos.fecha, empleadores.nombre_emp, actividades.nombre_act FROM calculos
INNER JOIN empleadores ON calculos.num_emp = empleadores.num_emp
INNER JOIN actividades ON calculos.num_actividad = actividades.num_actividad
WHERE empleadores.num_usuario = '1'
ORDER BY  FECHA DESC;


select nombre_act from actividades WHERE num_usuario='2';
INSERT  INTO actividades(nombre_act, num_usuario) 
SELECT * FROM( SELECT 'Desarrollo','1') AS tmp
WHERE NOT EXISTS (
	SELECT nombre_act FROM actividades WHERE nombre_act = 'Desarrollo'
) limit 1;
select * from actividades;
desc calculos;
INSERT INTO calculos(num_usuario,num_emp,num_actividad,fecha,hora_ent,hora_sal,horas_tra,descripcion,transporte)
VALUES('num_usuario', 'numemp',(SELECT num_actividad FROM actividades WHERE nombre_act = 'desarrollo'),'fecha','inicio', 'termino','trabajadas','detalle','transporte');

SELECT num_actividad FROM actividades WHERE nombre_act = 'desarrollo';

SELECT * FROM calculos;

SELECT fecha, empleadores.nombre_emp,actividades.nombre_act, horas_tra,descripcion,transporte FROM calculos
INNER JOIN actividades ON calculos.num_actividad = actividades.num_actividad
INNER JOIN empleadores ON calculos.num_emp = empleadores.num_emp
WHERE (SELECT num_usuario FROM usuarios WHERE correo = 'abelardo@mail.com') and calculos.num_cal='4';
