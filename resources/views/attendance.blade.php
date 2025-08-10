<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ setting('site.title') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        @if ($success)
        <meta http-equiv="refresh" content="5;url={{ url('/') }}">
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <section class="bg-gray-50 dark:bg-gray-900" style="background: rgb(17, 24, 39) !important;">
            @if ($clockedOut)
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-4 text-2xl text-center text-white font-extrabold tracking-tight flex items-center justify-center">
                            <span class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
                                <img class="w-8 h-8 mr-2" src="{{ 'storage/' . setting('site.logo') }}" alt="{{ setting('site.title') }} logo">
                                {{ setting('site.title') }}
                            </span>
                        </h5>
                        <div class="text-center">
                            <h3 style="color: green;">You have successfully clocked out today!</h3>
                        </div>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ url($clockedIn ? '/clock-out' : '/clock-in') }}" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    @csrf
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700" style="background: oklch(0.278 0.033 256.848);">
                        <h5 class="mb-4 text-2xl text-center text-white font-extrabold tracking-tight flex items-center justify-center">
                            <span class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ setting('site.title') }}
                            </span>
                        </h5>
                        @if ($success)
                            <div class="text-center">
                                <h3 style="color: green;">{{ $success }}</h3>
                                <span class="text-xs">You will be redirected in 5 seconds...</span>
                            </div>
                        @else
                            <ul role="list" class="space-y-5 my-7 text-center">
                                <li>
                                    <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"><b class="text-white">IP Address</b> <br> {{ $ip }}</span>
                                </li>
                                <li>
                                    <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"><b class="text-white">Current Time</b> <br> {{ now()->format('F j, Y h:i:s A') }}</span>
                                </li>
                            </ul>
                            @error('ip')
                                <div style="color: red;" class="mb-7">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                                {{ $clockedIn ? 'Clock Out' : 'Clock In' }}
                            </button>
                        @endif
                    </div>
                </form>
            @endif
        </section>
    </body>
</html>
