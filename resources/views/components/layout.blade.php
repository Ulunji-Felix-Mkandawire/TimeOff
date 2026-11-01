<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite('resources/css/app.css')
        <title>TimeOFF</title>
    </head>

    <body class="grid grid-cols-10 bg-main-background h-screen">
        {{-- LAYOUT --}}
        <aside class="flex flex-col justify-between col-span-2 my-2.5 px-3.5 py-1.5">
            {{-- HEADER & LINKS --}}
            <div>
                <x-aside.header />
                <div class="mt-5">
                    <x-aside.nav-links />
                </div>
            </div>
            {{-- FOOTER --}}
            <div>
                <p>Settings</p>
            </div>
        </aside>
        <main class="col-span-8 bg-surface shadow m-2.5 p-1.5 border border-divider rounded-lg">
            {{ $slot }}
        </main>
    </body>

</html>
