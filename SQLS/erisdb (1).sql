-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2022 a las 01:22:27
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erisdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblapplicants`
--

CREATE TABLE `tblapplicants` (
  `APPLICANTID` int(11) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `SEX` varchar(11) NOT NULL,
  `CIVILSTATUS` varchar(30) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `BIRTHPLACE` varchar(255) NOT NULL,
  `AGE` int(2) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `DEGREE` text NOT NULL,
  `APPLICANTPHOTO` varchar(255) NOT NULL,
  `NATIONALID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblapplicants`
--

INSERT INTO `tblapplicants` (`APPLICANTID`, `FNAME`, `LNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`, `CONTACTNO`, `DEGREE`, `APPLICANTPHOTO`, `NATIONALID`) VALUES
(2022017, 'Jefferson', 'Ahimar', 'Av. Flores de Primavera 585', 'Masculino', 'Soltero(a)', '1999-09-11', 'SJL', 23, 'jeffersonahimar', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'jeffersonahimar@gmail.com', '920574430', 'Sistemas', 'photos/22092022114937avatar.png', ''),
(2022020, 'Wilmer', 'Wilmer', 'Wilmer', 'Femenino', 'Soltero(a)', '1995-01-17', 'Wilmer', 27, 'wilmer', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sdsadas@asdas.com', 'Wilmer', 'Wilmer', 'photos/22092022114903avatar.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblattachmentfile`
--

CREATE TABLE `tblattachmentfile` (
  `ID` int(11) NOT NULL,
  `FILEID` varchar(30) DEFAULT NULL,
  `JOBID` int(11) NOT NULL,
  `FILE_NAME` varchar(90) NOT NULL,
  `FILE_LOCATION` varchar(255) NOT NULL,
  `USERATTACHMENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int(11) NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblautonumbers`
--

INSERT INTO `tblautonumbers` (`AUTOID`, `AUTOSTART`, `AUTOEND`, `AUTOINC`, `AUTOKEY`) VALUES
(1, '02983', 9, 1, 'userid'),
(2, '000', 78, 1, 'employeeid'),
(3, '0', 21, 1, 'APPLICANT'),
(4, '69125', 62, 1, 'FILEID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CATEGORYID` int(11) NOT NULL,
  `CATEGORY` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGORYID`, `CATEGORY`) VALUES
(10, 'Tecnología'),
(11, 'Producción Agropecuaria'),
(12, 'Mecánica Automotriz'),
(13, 'TI'),
(14, 'Industrias Alimentarias'),
(15, 'RR.HH.'),
(23, 'Arquitectura de Plataformas'),
(24, 'Enfermería'),
(25, 'Construcción Civil'),
(26, 'Contabilidad'),
(27, 'Computación e Informática'),
(28, 'Administración');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int(11) NOT NULL,
  `COMPANYNAME` varchar(90) NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `COMPANYCONTACTNO` varchar(30) NOT NULL,
  `COMPANYSTATUS` varchar(90) NOT NULL,
  `COMPANYUSER` varchar(90) NOT NULL,
  `COMPANYPASS` varchar(90) NOT NULL,
  `COMPANYPHOTO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `COMPANYSTATUS`, `COMPANYUSER`, `COMPANYPASS`, `COMPANYPHOTO`) VALUES
(8, 'Silfersystem', 'Av. Arequipa 1345', '92010156', 'enabled', 'silfer', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'photos/23092022011238logo_silfer.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `FEEDBACKID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `REGISTRATIONID` int(11) NOT NULL,
  `FEEDBACK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `CATEGORY` varchar(250) NOT NULL,
  `OCCUPATIONTITLE` varchar(90) NOT NULL,
  `REQ_NO_EMPLOYEES` int(11) NOT NULL,
  `SALARIES` double NOT NULL,
  `DURATION_EMPLOYEMENT` varchar(90) NOT NULL,
  `QUALIFICATION_WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `PREFEREDSEX` varchar(30) NOT NULL,
  `JOBSTATUS` varchar(90) NOT NULL,
  `DATEPOSTED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `JOBSTATUS`, `DATEPOSTED`) VALUES
(6, 8, 'Tecnología', 'Prueba', 1, 200, '4 meses', '5 años en puestos similares', 'Desarrollo Web PHP', 'Femenino', '', '2022-09-20 19:13:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbljobregistration`
--

CREATE TABLE `tbljobregistration` (
  `REGISTRATIONID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `APPLICANT` varchar(90) NOT NULL,
  `REGISTRATIONDATE` date NOT NULL,
  `REMARKS` varchar(255) NOT NULL DEFAULT 'Pending',
  `FILEID` varchar(30) DEFAULT NULL,
  `PENDINGAPPLICATION` tinyint(1) NOT NULL DEFAULT 1,
  `HVIEW` tinyint(1) NOT NULL DEFAULT 1,
  `DATETIMEAPPROVED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`, `HVIEW`, `DATETIMEAPPROVED`) VALUES
(19, 9, 7, 2022017, 'Jefferson Huaman Perez', '2022-09-21', 'Pending', '20226912548', 1, 1, '2022-09-21 20:14:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` varchar(30) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PICLOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `PASS`, `ROLE`, `PICLOCATION`) VALUES
('029838', 'DRE CAJAMARCA', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblapplicants`
--
ALTER TABLE `tblapplicants`
  ADD PRIMARY KEY (`APPLICANTID`);

--
-- Indices de la tabla `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indices de la tabla `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CATEGORYID`);

--
-- Indices de la tabla `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indices de la tabla `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`FEEDBACKID`);

--
-- Indices de la tabla `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`JOBID`);

--
-- Indices de la tabla `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  ADD PRIMARY KEY (`REGISTRATIONID`);

--
-- Indices de la tabla `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblapplicants`
--
ALTER TABLE `tblapplicants`
  MODIFY `APPLICANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2022021;

--
-- AUTO_INCREMENT de la tabla `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `FEEDBACKID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  MODIFY `REGISTRATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
