desc usuarios;

SELECT * FROM calculos;

DELETE FROM calculos 
WHERE num_cal = '3';
SELECT usuarios.num_usuario FROM usuarios WHERE usuarios.correo = 'anibalitoaqui@gmail.com';


select * from ;

SELECT usuarios.nombre_user, usuarios.correo, usuarios.numero, usuarios.rfc, 
empleadores.nombre_emp,empleadores.correo_emp, calculos.fecha,actividades.nombre_act, calculos.descripcion, calculos.horas_tra
FROM usuarios
INNER JOIN calculos on usuarios.num_usuario = calculos.num_usuario
inner join empleadores on calculos.num_emp = empleadores.num_emp
inner join actividades on calculos.num_actividad = actividades.num_actividad
WHERE usuarios.num_usuario = '1' AND empleadores.nombre_emp = 'Carlos Sosa';
/*Intento de reporte por empleador*/
select calculos.fecha, actividades.nombre_act, calculos.descripcion, calculos.hora_ent, 
calculos.hora_sal, calculos.horas_tra, empleadores.cuota, (empleadores.cuota*calculos.horas_tra) as subtotal_actividad,calculos.transporte,
(empleadores.cuota*calculos.horas_tra+calculos.transporte) as total_actividad
FROM calculos
INNER JOIN actividades ON calculos.num_actividad = actividades.num_actividad
INNER JOIN empleadores ON calculos.num_emp = empleadores.num_emp
WHERE calculos.num_usuario = (SELECT num_usuario FROM usuarios where correo = 'abelardo@mail.com')
AND empleadores.nombre_emp = 'Carlos Sosa';

SELECT * FROM calculos WHERE num_usuario = '1';