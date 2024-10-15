
<html style="margin: 0;">
    <head>
        {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
        <style>
{{ file_get_contents(public_path('/css/w3.css')) }} header {
    background-color: #007BFF;
    height: 60px;
}

        p {
            font-size: 12pt;
            text-align: justify;
        }

        ul {
            font-size: 12pt;
            margin-top: 0;
            margin-bottom: 0;
        }

        td{
            font-size: 12pt;
        }
        </style>
        @yield('css')
    </head>
    <header>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/logo-white.png'))) }}"
             style="position: fixed;left: 10px;top:-20px; width: 120px;height: 100px;">
        <h6 style="color: white; position: fixed;right: 10px;">CENTRO DE OZONOTERAPIA<br>Y MEDICINA REGENERATIVA</h6>
    </header>
    <body>
        <div style="margin: 0 2cm;">
            @yield('content')
        </div>
    </body>
</html>
