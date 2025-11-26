<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>FutbolHub</title>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <header class="w-full bg-gray-50 border-b">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <div class="text-xl font-bold tracking-tight text-gray-900">FutbolHub</div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="rounded-lg bg-green-600 px-5 py-2 text-sm font-semibold text-white shadow-md transition hover:bg-green-700 hover:scale-[1.02]">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                    class="rounded-lg border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-900 transition hover:bg-gray-100 hover:scale-[1.02]">
                    Crear cuenta
                </a>
            </div>
        </nav>
    </header>


    <!-- HERO -->
    <section class="bg-gray-50">
        <div class="mx-auto max-w-4xl flex flex-col items-center px-4 py-20 text-center">

            <div
                class="mb-4 inline-flex items-center gap-2 rounded-full bg-green-100 px-4 py-1 text-xs font-semibold uppercase tracking-wide text-green-700 shadow-sm">
                <span>🎯</span> <span>Ahora disponible</span>
            </div>

            <h1 class="mb-6 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                Reserva canchas de
                <span class="block">fútbol al instante</span>
            </h1>

            <p class="mb-10 max-w-2xl text-base text-gray-600 sm:text-lg">
                Encuentra las mejores canchas cerca de ti, compara precios y reserva en segundos.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg bg-green-700 px-8 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-800 hover:scale-[1.02]">
                    Reservar Ahora
                    <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg border border-green-700 bg-white px-8 py-3 text-sm font-semibold text-green-700 transition hover:bg-green-50 hover:scale-[1.02]">
                    Ver Canchas
                </a>
            </div>
        </div>
    </section>


    <!-- ¿POR QUÉ ELEGIR FUTBOLHUB? -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-12">
                ¿Por qué elegir FutbolHub?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div
                    class="rounded-2xl bg-white p-8 shadow-sm border border-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 text-3xl text-green-700">📍</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Canchas Cercanas</h3>
                    <p class="text-gray-600 text-sm">Encuentra las mejores canchas a menos de 5 km de tu ubicación</p>
                </div>

                <div
                    class="rounded-2xl bg-white p-8 shadow-sm border border-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 text-3xl text-blue-600">🕒</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Reserva Rápida</h3>
                    <p class="text-gray-600 text-sm">Haz tu reserva en menos de 60 segundos</p>
                </div>

                <div
                    class="rounded-2xl bg-white p-8 shadow-sm border border-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 text-3xl text-green-700">👥</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Comunidad</h3>
                    <p class="text-gray-600 text-sm">Conecta con jugadores y organiza partidos fácilmente</p>
                </div>

            </div>
        </div>
    </section>


    <!-- RESERVA TU CANCHA HOY -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div
                class="rounded-3xl bg-gradient-to-r from-green-50 to-gray-100 border border-green-100 p-10 md:p-14 flex flex-col md:flex-row gap-10 shadow-sm">

                <div class="md:w-1/2 space-y-4">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Reserva tu cancha hoy</h2>

                    <p class="text-gray-600 text-sm md:text-base">Selecciona tu ubicación, fecha y hora, y confirma tu
                        reserva.</p>
                    <p class="text-gray-600 text-sm md:text-base">Estamos abiertos todos los días de 7 AM a 10 PM.</p>

                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-full bg-green-700 hover:bg-green-800 hover:scale-[1.02] text-white font-semibold px-6 py-3 text-sm shadow-md transition">
                        Crea una cuenta ya <span class="ml-2 text-lg">→</span>
                    </a>
                </div>

                <div class="md:w-1/2 space-y-4">

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4 transition hover:-translate-y-1 hover:shadow-md">
                        <p class="text-sm font-semibold text-gray-900"><span
                                class="mr-2 text-pink-600">📍</span>Ubicación</p>
                        <p class="text-sm text-gray-600">Escalón / San Benito / Centro Histórico, San Salvador</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4 transition hover:-translate-y-1 hover:shadow-md">
                        <p class="text-sm font-semibold text-gray-900"><span class="mr-2 text-purple-600">📅</span>Fecha
                            & Hora</p>
                        <p class="text-sm text-gray-600">Viernes, 8:00 PM – 10:00 PM</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4 transition hover:-translate-y-1 hover:shadow-md">
                        <p class="text-sm font-semibold text-gray-900"><span class="mr-2 text-sky-600">💳</span>Pago</p>
                        <p class="text-sm text-gray-600">Método seguro y rápido</p>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- CTA FINAL -->
    <section class="bg-gray-50 py-20 border-t border-gray-200">
        <div class="max-w-4xl mx-auto text-center px-6">

            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                ¿Listo para jugar?
            </h2>

            <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                Únete a miles de jugadores que ya disfrutan reservando sus canchas con FutbolHub.
            </p>

            <a href="{{ route('register') }}"
                class="inline-block bg-green-700 hover:bg-green-800 hover:scale-[1.02] text-white font-semibold px-8 py-3 rounded-lg shadow-sm transition">
                Crear una cuenta ya
            </a>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="bg-gray-50 py-8 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-gray-600 text-sm">
                © 2025 FutbolHub. Todos los derechos reservados.
            </p>

            <div class="flex gap-6 text-sm text-gray-600">
                <a href="#" class="hover:text-gray-900 hover:scale-[1.02] transition">Privacidad</a>
                <a href="#" class="hover:text-gray-900 hover:scale-[1.02] transition">Términos</a>
                <a href="#" class="hover:text-gray-900 hover:scale-[1.02] transition">Contacto</a>
            </div>

        </div>
    </footer>

</body>

</html>