<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
            padding:0;
        }
        body{
            padding:0;
        }
    </style>
</head>
<body>
@foreach ($barcode as $value)


^XA
^FO50,60^A0,30^FDDRIMA - ORTOPEDIA DIGITAL^FS
^FO45, 120^ADN, 12, 7^FD {{ $value['nombre'] }} ^FS
^FO45, 150^ADN, 12, 7^FD {{ $value['descripcion'] }} ^FS
^FO90,190^BY4^BC,60,N,N,N,N^A1,20,^FD{{ $value['id'] }}^FS
^FO90, 260^ADN, 12, 7^FD www.drima.cl - La Serena ^FS
^FO25,25^GB435,275,2^FS
^XZ
 
                
<br><br>

    <!--
       

        <table style="border:4px solid #000; border-radius:0px;padding:5px">
        <tr>
            <td colspan="2" style="border:5px 0px 2px 0px solid #000;padding:10px">
               <center> <img src="https://drima.cl/wp-content/uploads/2022/08/logo-drima-ortopedia-digital-transparent.png" alt="" width="100"></center>
            </td>
        </tr>
        <tr style="border-top:4px solid #000; border-bottom: 4px solid #000">
            <td colspan="2">
                <hr>
                <div style="text-align:left;padding:10px">
                    <b>{{ $value['nombre'] }}<br>
                    <span style="font-size:12px;line-height: -100">
                    {{ $value['descripcion'] }}
                    </span>
                </div>
                <hr>
            </td>            
        </tr>
        <tr>
            <td style="padding:10px">
                <center>
                <img src="https://graffica.info/wp-content/uploads/2017/02/logoreciclaje-300x297.jpg" alt="" width="40">
                <br> <span style="font-size:9px">Producto Biodegradable</span>
                </center>
            </td>
            <td style="border-left:1px solid #000;padding:10px">
                <center>
                <?php echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($value['id'], 'C39',2,30) . '" alt="barcode" style="width:200px"   />'; ?>
                <br> <span style="font-size:9px">La Serena - Chile</span>
                </center>
            </td>
        </tr>
    </table>
    <br><br><br>
    -->
@endforeach
</body>
</html>