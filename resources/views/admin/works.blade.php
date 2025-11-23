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
                
                @if(session('error'))
                    <div style="color: red; margin: 10px 0;">{{ session('error') }}</div>
                @endif
                
                @if($errors->any())
                    <div style="color: red; margin: 10px 0; background: #fee; padding: 10px;">
                        <strong>Validation Errors:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <details>
                            <summary>Debug Info</summary>
                            <pre>{{ print_r($errors->messages(), true) }}</pre>
                        </details>
                    </div>
                @endif
                
                <form action="{{ route('admin.works') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="inputs">
                        <div class="input-group">
                            <div class="input-title">title</div>
                            <textarea name="title" id="" cols="50" rows="2" required></textarea>
                        </div>
                        <div class="input-group">
                        <div class="input-title">read more</div>
                            <textarea name="content" id="" cols="50" rows="2" required></textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-title">video url</div>
                            <input type="text" name="video">
                        </div>
                        <div class="input-group">
                            <div class="input-title">thumbnail</div>
                            <input type="file" name="thumbnail">
                        </div>
                        <button type="submit">upload</button>
                    </div>
                </form>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>