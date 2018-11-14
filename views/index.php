<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if(\jlaucho\practica\AccessHandler::check(['student'])): ?>
<a href="alumno.php">Alumno</a>
<?php  endif; ?>
<?php if(\jlaucho\practica\AccessHandler::check(['teacher'])): ?>
<a href="profesor.php">profesor</a>
<?php  endif; ?>
</body>
</html>