<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <h1>Recuperar Contraseña</h1>
    <p>Sus nuevas credenciales son: <br> <br>

        <b>Correo: </b>
        {{$datos->login}} <br>
        <b>Contraseña: </b>
         {{$password}}

    <p>Le recomendamos por seguridad cambiar la contraseña una vez ingrese a su cuenta.</p>
        
    </p>
</body>
</html>
