<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
</head>
<body>
         <h1>Mensaje de {{ $contacto['name'] }}</h1> 
         <h3>Asunto: {{ $contacto['asunto'] }}</h3> 
        <p> {{$contacto['message']}} </p>
</body>
</html>