<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Loan calculator</title>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 10px;
            }

            .flex-center {
                align-items: center;
                justify-content: center;
            }


            .form-group {
                margin:10px;
            }
            .form-group input, .form-group select, .form-group button {
                padding: 8px 20px;
            }
            .form-group.error input {
                border:1px solid red;
            }

            .has-error {
                font-size: 12px;
                color:red;
            }

            .table {
                font-size:13px;
                border:1px solid #ccc;
                border-collapse: collapse;
            }

            .table td,  .table th {
                border:1px solid #ccc;
                padding: 4px;
                border-collapse: collapse;
            }

            .table th {

            }

        </style>
    </head>
    <body>
        <div class="flex-center">
            @yield('content')
        </div>
    </body>
</html>
