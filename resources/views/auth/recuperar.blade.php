<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{('Recuperar Contrase���a')}}</title>
</head>
<body>
    <h1>Recuperar Contrase���a</h1>
    <p>Sus nuevas credenciales son: <br> <br>

        <b>Correo: </b>
        {{$datos->login}} <br>
        <b>Contrase���a: </b>
         {{$password}}

    <p>Le recomendamos por seguridad cambiar la contrase���a una vez ingrese a su cuenta.</p>
        
    </p>
</body>
</html>
