<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />
    <title>Gagal</title>
</head>
<body>

    <div class="my-10">
        <figure class="max-w-screen-md h-screen mx-auto text-center">
            <img class="rounded-full w-96 h-96 mx-auto mb-5" src="fail.jpeg" alt="image description">
            <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
            </svg>
            <blockquote>
                <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"Pembayaran Gagal!"</p>
            </blockquote>
            <figcaption class="flex items-center justify-center mt-6 space-x-3">
                <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                    <a href="{{ route('home') }}" class="pr-3 font-medium text-gray-900 dark:text-white underline">Home</a>
                    <a class="pl-3 text-sm text-gray-500 dark:text-gray-400">Website E-Learning</a>
                </div>
            </figcaption>
        </figure>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>
</html>
