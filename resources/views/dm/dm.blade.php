<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $peeruser->name }} さんとのDM</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .single-message {
            background: rgb(230, 230, 230);
            border-radius: 30px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .received {
            margin-right: 10% !important;
        }

        .sent {
            margin-left: 10% !important;
            background: rgb(0, 165, 255);
            color: white !important;
        }
    </style>
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <div class="sticky top-0 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <p class="text-cyan-400 text-xl">{{ $peeruser->name }}さんとのDM</p>
            </div>
        </div>
        <div class="flex-1 min-h-full">
            @livewire('dmbody', ['user_id' => $user_id, 'user_id2' => $user_id2])
        </div>
        <div class="sticky bottom-0 shadow-lg border-t border-gray-200">
            @livewire('dmsender', ['user_id' => $user_id, 'user_id2' => $user_id2, 'peeruser_id' => $peeruser,
            'myuser_id' => $myuser_id])
        </div>
    </div>
</body>

@livewireScripts

</html>