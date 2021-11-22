
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>StockTrader</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: url('https://www.imcgrupo.com/wp-content/uploads/2019/12/Is-forex-trading-legal-in-Indonesia.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;


        }
    </style>
</head>

<body>

<div
    class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden text-center px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/news') }}" class="text-sm text-white-700 dark:text-white-500 ">News</a>
                <a href="{{ url('/search') }}" class="text-sm text-white-700 dark:text-white-500 ">Search</a>
                <a href="{{ route('user.profile') }}" class="text-sm text-white-700 dark:text-white-500 ">MyAccount</a>
            @else
                <div class="box-content backdrop-opacity-50">
                    <a href="{{ route('login') }}" class="text-sm text-white-700 dark:text-white-500 ">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 text-sm text-white-700 dark:text-white-500 ">Register</a>
                    @endif
                </div>

            @endauth
        </div>
    @endif
</div>


{{--<img src="https://i.pinimg.com/originals/9b/12/f6/9b12f67e963c58927c492d7c6df7cc99.png" alt="LOGO">--}}
</body>

</html>
