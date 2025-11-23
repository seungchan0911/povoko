<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>povoko studio</title>
    <link rel="shortcut icon" href="{{ asset('img/source/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
</head>
<body data-page="home">
    <div class="container">
        <x-layout.header />
        <main data-scroll-container>
            <section class="admin" data-scroll>
                <a href="{{ route('admin.operation') }}">Go to operation</a>
                <a href="{{ route('admin.contact') }}">Go to check contact</a>
                <a href="{{ route('admin.works') }}">Go to control works</a>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; padding: 0;">Logout</button>
                </form>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>