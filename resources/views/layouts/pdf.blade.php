
<html style="margin: 0;">
<head>
    <style>
        {{ file_get_contents(public_path('/css/w3.css')) }}

        @page {
            margin-top: 100px; /* Espacio para el encabezado */
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #007BFF;
            text-align: center;
        }

        .header-content {
            color: white;
            font-size: 10pt;
            line-height: 1.2;
            padding: 10px;
        }

        p, ul, td {
            font-size: 12pt;
            text-align: justify;
        }

        body {
            padding-top: 60px; /* Asegura que el contenido no se superponga al encabezado */
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
