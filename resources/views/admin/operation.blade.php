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
            <section class="admin operation" data-scroll>
                <a href="{{ route('admin.index') }}">Back</a>
                
                @if(session('success'))
                    <div style="color: green; margin: 10px 0;">{{ session('success') }}</div>
                @endif
                
                @if($errors->any())
                    <div style="color: red; margin: 10px 0;">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.operation') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs">
                        <div class="input-group">
                            <div class="input-title">text1</div>
                            <textarea name="text1" id="" cols="50" rows="2" required>{{ $text->text1 }}</textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-title">text2</div>
                            <textarea name="text2" id="" cols="50" rows="2" required>{{ $text->text2 }}</textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-title">background video</div>
                            <input type="file" name="background_video" accept="video/*">
                            @if($text->background_video)
                                <small>Current: {{ basename($text->background_video) }}</small>
                            @endif
                        </div>
                        <button type="submit">Change</button>
                    </div>
                </form>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>