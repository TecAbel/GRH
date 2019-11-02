desc usuarios;

SELECT * FROM usuarios;
SELECT * FROM empleadores;
SELECT * FROM calculos;

DELETE FROM calculos 
WHERE num_cal = '3';
SELECT usuarios.num_usuario FROM usuarios WHERE usuarios.correo = 'anibalitoaqui@gmail.com';


select * from CALCULOS;

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
#calcular subtotal
UPDATE calculos 
SET subtotal_cal =  (
	horas_tra*(
    SELECT cuota 
    FROM empleadores 
    where num_usuario = (
		SELECT num_usuario 
		FROM usuarios 
		WHERE correo = 'abelardo@mail.com'
        ) 
	AND num_emp = '1'
	)
)
WHERE calculos.num_emp = '1' AND calculos.num_usuario = '1';

#CALCULAR TOAL
UPDATE calculos
SET total_cal = (
	subtotal_cal + transporte
)
WHERE calculos.num_emp = '2' AND calculos.num_usuario = '1';
SELECT * FROM calculos;


SELECT empleadores.nombre_emp, calculos.total_cal as monto
FROM empleadores
INNER JOIN calculos ON empleadores.num_emp = calculos.num_emp
WHERE calculos.num_actividad is not null AND calculos.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = 'abelardo@mail.com');


#total de cada empelador
SELECT empleadores.num_emp, empleadores.nombre_emp as empleador , SUM(calculos.total_cal) as monto_total
FROM empleadores 
INNER JOIN calculos ON calculos.num_emp = empleadores.num_emp
WHERE calculos.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = 'abelardo@mail.com')
group by empleadores.nombre_emp
ORDER BY total_cal DESC;

#info de un reporte
SELECT nombre_user FROM usuarios WHERE correo = '';

SELECT date_format(calculos.fecha,'%d/%m/%y'), actividades.nombre_act, calculos.descripcion, calculos.total_cal
FROM calculos
INNER JOIN actividades ON actividades.num_actividad = calculos.num_actividad
WHERE calculos.num_emp='1' AND calculos.num_usuario=(SELECT num_usuario FROM usuarios WHERE correo = 'abelardo@mail.com');

#total de un empelador

SELECT sum(calculos.total_cal)
FROM calculos
WHERE calculos.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo ='abelardo@mail.com') 
AND calculos.num_emp = '1';

SELECT nombre_emp, nombre_emp_emp 
        FROM empleadores
        WHERE num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = 'abelardo@mail.com')
        AND num_emp = '1';
        
SELECT date_format(calculos.fecha,'%d/%m/%y') as fecha, actividades.nombre_act, calculos.descripcion, calculos.transporte, calculos.total_cal
        FROM calculos
        INNER JOIN actividades ON actividades.num_actividad = calculos.num_actividad
        WHERE calculos.num_emp='1' AND calculos.num_usuario=(SELECT num_usuario FROM usuarios WHERE correo = 'abel1996abel@gmail.com');
        
SELECT date_format(calculos.fecha,'%d/%m/%y') as fecha,  calculos.transporte, calculos.hora_ent, calculos.hora_sal, calculos.horas_tra
FROM calculos
WHERE calculos.num_emp='1' AND calculos.num_usuario=(SELECT num_usuario FROM usuarios WHERE correo = 'abel1996abel@gmail.com');