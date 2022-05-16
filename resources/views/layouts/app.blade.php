<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireStyles
</head>

<body class="font-sans antialiased bg-slate-100">
    @include('posts.flashnotice.flashnotice')
    <div class="w-full min-h-screen sm:flex sm:flex-row">
        <div class="flex-auto sm:float-right relative sm:h-full sm:w-full">
            <div class="flex flex-col min-h-screen">
                <!-- Page Heading -->
                <header class="bg-slate-50 shadow">
                    <div class="flex items-center max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                        @include('layouts.sidebar')
                        {{ $header }}
                    </div>
                </header>
                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/sweetalerthua.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/trumbowyg.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/paint.js') }}"></script>

</body>
@livewireScripts
<script type="text/javascript">
    var csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('Content');

if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        navigator.serviceWorker.register("{{ asset('sw.js') }}");
    });
}

function urlBase64ToUint8Array(base64String) {
    var padding = "=".repeat((4 - (base64String.length % 4)) % 4);
    var base64 = (base64String + padding).replace(/\-/g, "+").replace(/_/g, "/");

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }

    return outputArray;
}

function subscribe(sub) {
    const key = sub.getKey('p256dh')
    const token = sub.getKey('auth')
    const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

    const data = {
        endpoint: sub.endpoint,
        public_key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        auth_token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        encoding: contentEncoding,
    };

    fetch("{{ route('subscribe') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrftoken
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

var VAPID_PUBLIC_KEY = "{{ config('webpush.vapid_public_key') }}";

function enablePushNotifications() {
    navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription().then(subscription => {
            if (subscription) {
                return subscription;
            }

            const serverKey = urlBase64ToUint8Array(VAPID_PUBLIC_KEY);

            return registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: serverKey
            });
        }).then(subscription => {
            if (!subscription) {
                alert('Error occured while subscribing');
                return;
            }
            subscribe(subscription);
        });
    });
}

function disablePushNotifications() {
    navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription().then(subscription => {
            if (!subscription) {
                return;
            }

            subscription.unsubscribe().then(() => {
                fetch("{{ route('unsubscribe') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrftoken
                    },
                    body: JSON.stringify({
                        endpoint: subscription.endpoint
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            })
        });
    });
}

document.getElementById('enable-push').addEventListener('click', function () {
    enablePushNotifications();
    toastr.success('プッシュ通知がオンになりました！');
});
document.getElementById('disable-push').addEventListener('click', function () {
    disablePushNotifications();
    toastr.success('プッシュ通知をオフにしました');
});
</script>

</html>