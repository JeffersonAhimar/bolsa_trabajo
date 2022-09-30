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



SELECT FILE_LOCATION FROM tblattachmentfile af
INNER JOIN tbljobregistration jr
ON af.FILEID = jr.FILEID
WHERE jr.REGISTRATIONID = 34 LIMIT 1;



DELETE FROM tblattachmentfile
WHERE FILEID IN 
( SELECT af.FILEID
FROM tblattachmentfile af
INNER JOIN tbljobregistration jr ON (jr.FILEID = af.FILEID)
WHERE jr.REGISTRATIONID = 29)


DELETE tblattachmentfile
FROM tblattachmentfile
INNER JOIN tbljobregistration jr 
ON (jr.FILEID = tblattachmentfile.FILEID)
WHERE jr.REGISTRATIONID = 29



DELETE FROM tableA
WHERE ROWID IN 
  ( SELECT q.ROWID
    FROM tableA q
      INNER JOIN tableB u on (u.qlabel = q.entityrole AND u.fieldnum = q.fieldnum) 
    WHERE (LENGTH(q.memotext) NOT IN (8,9,10) OR q.memotext NOT LIKE '%/%/%')
      AND (u.FldFormat = 'Date'));



SELECT * FROM tbljobregistration
WHERE JOBID = ID;


SELECT * FROM tbljob
WHERE COMPANYID = ID;





-- 


SELECT * FROM tbljob
WHERE COMPANYID = 1;


SELECT DISTINCT institution FROM mo_user;



SELECT * FROM mo_user WHERE username='invitado1' OR username='invitado2';


SELECT * FROM mo_context WHERE id = 11761 OR id = 11693; 


SELECT * FROM mo_context WHERE instanceid = 4809;








SELECT * FROM tbljob
WHERE COMPANYID = 1;


SELECT DISTINCT institution FROM mo_user;


SELECT * FROM mo_user WHERE institution = 'CUTERVO';

SELECT * FROM mo_user WHERE username=27439518;

SELECT * FROM mo_user WHERE username='invitado1' OR username='invitado2';


SELECT * FROM mo_context WHERE id = 11761 OR id = 11693; 


SELECT * FROM mo_context WHERE instanceid = 4809;


SELECT mc.id, mu.picture FROM mo_user mu
INNER JOIN mo_context mc ON mu.id=mc.instanceid
WHERE mu.id = 4809;



























