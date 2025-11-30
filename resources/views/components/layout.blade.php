<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Boards</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>

</head>
@props(['bgColor'   =>  null,   'pageClass' =>  null])
<body class="min-h-screen" style="background-color: {{ $bgColor }}">

    @include('components.navbar')

    <div class="flex min-h-screen"> 
        
        <x-sidebar>
            {{ $sidebar ?? '' }}
        </x-sidebar>

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    
</body>
</html>