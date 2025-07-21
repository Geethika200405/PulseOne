<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') <!-- if you're using Vite/Tailwind -->
    <script src="https://kit.fontawesome.com/bc9b460555.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="flex">
        <!-- Sidebar -->
        @include('memberDashboard.components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 min-h-screen">
            <!-- Header -->
            @include('memberDashboard.components.header')

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
