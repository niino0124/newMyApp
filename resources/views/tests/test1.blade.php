<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>マイアプリ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">


    </head>
    <body>
        <div class="container">
            <main class="row justify-content-center">
                <div class="blue-board ">
                    <div class="header">
                      <div class="simple-wrap" style="justify-content:flex-end;">
                        <a class="btn-simple"> This is test !
                        </a>
                        <a href="{{ route('test.list') }}" class="btn-simple">マイテスト</a>
                      </div>
                    </div>
                    <div class="man-body">
                       
                    </div>
                </div>
            </main>
        </div>

    </body>
</html>
