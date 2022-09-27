SELECT FILEID FROM tbljobregistration jr
INNER JOIN tblapplicants a
ON jr.APPLICANTID = a.APPLICANTID
INNER JOIN tblattachmentfile af
ON af.FILEID 




SELECT * FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID

SELECT * FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
INNER JOIN tblapplicants a
ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016



DELETE tblattachmentfile FROM tblattachmentfile af
INNER JOIN tbljobregistration jr ON af.FILEID = jr.FILEID
INNER JOIN tblapplicants a ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016;

DELETE tblattachmentfile af FROM af
JOIN tbljobregistration jr ON af.FILEID = jr.FILEID
WHERE af.FILEID = 20226912536
JOIN tblapplicants a ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016;








DELETE FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
INNER JOIN tblapplicants a
ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016


DELETE FROM tbl attachmentfile WHERE FILEID IN (
	SELECT * FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
INNER JOIN tblapplicants a
ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016
)

DELETE tblattachmentfile FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
INNER JOIN tblapplicants a
ON jr.APPLICANTID = a.APPLICANTID
WHERE a.APPLICANTID =  2022016


DELETE FROM tblattachmentfile WHERE 







Required No. of Employee's
Nro. de Empleados Requeridos

Salario
Duración del Empleo

Género Preferido
Sector de Vacante

Calificación/Experiencia Laboral
Descripción del Trabajo

Compañía
Ubicación

Adjunta tu CV aquí

Fecha de Publicación


SEARCH
BÚSQUEDA
COMPAÑÍA
CATEGORÍA

Categoría



Edad inválida. Sólo mayores de 18 años son permitidos.

















SELECT FILE_LOCATION FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
WHERE jr.REGISTRATIONID = 28






























