<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>500 Server Error</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-white min-h-screen">
    <div class="flex justify-center items-center min-h-screen">
        <div>
            <div class="text-center" style="color: rgb(112, 112, 112);">
                <span class="sm:text-sm text-xs">申し訳ございません。サーバー側でエラーが出ているようです。管理者までお問い合わせください。</span>
            </div>
            <a href="{{ route('index') }}">
                <button class="block mx-auto btn btn-outline btn-circle sm:btn-md btn-sm mt-6 sm:w-80 w-56">
                    <div class="text-center">
                        <span class="sm:text-sm text-xs">ホームに戻る</span>
                    </div>
                </button>
            </a>
        </div>
    </div>
</body>

</html>