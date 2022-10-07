<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @foreach ($barcode as $value)
        {{ $value['id'] }}<br>
        {{ $value['nombre'] }}<br>
        {{ $value['descripcion'] }}<br>
        {!! DNS1D::getBarcodeHTML($value['id'], "C39") !!}
        <hr>
    @endforeach

    
</body>
</html>