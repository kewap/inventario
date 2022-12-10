<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet"> <!--Añadimos el css generado con webpack-->
    </head>
    <body>
    @extends('layouts.app')

@section('content')
<div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
                <despachodrima></despachodrima><!--Añadimos nuestro componente vuejs-->
            </div>
@endsection
            
        <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
    </body>
</html>