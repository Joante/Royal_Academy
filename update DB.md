Fecha de examen -> sacar UQ a materia y sede
TABLA EXAMENREALIZADO -> AGREGAR COLUMNA -> Examen_idExamen int(11), que sea foreing key -> FK_idAlumno
            

			
Crear STORE -> 

CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_respuestas_realizadas`(IN p_idex INT,
  IN p_rta INT)
BEGIN
	 insert into examen_has_respuesta(respuesta_idrespuesta, ExamenRealizado_idExamenRealizado) values (p_idex, p_rta);
END

