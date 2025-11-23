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
            <section class="login" data-scroll>
                <form action="{{ route('admin.auth') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-title">Password</div>
                        <input type="password" name="password" required>
                    </div>
                    <button>Log in</button>
                </form>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>