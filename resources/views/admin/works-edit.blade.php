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
                <a href="{{ route('works.show', $work->id) }}">Back</a>
                
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
                    </div>
                @endif
                
                <form action="{{ route('admin.works.update', $work->id) }}" method="POST" data-autosave="admin-works-edit">
                    @csrf
                    @method('PUT')
                    <div class="inputs">
                        <div class="input-group">
                            <div class="input-title">title</div>
                            <textarea name="title" id="" cols="50" rows="2" required>{{ old('title', $work->title) }}</textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-title">read more</div>
                            <textarea name="content" id="" cols="50" rows="2" required>{{ old('content', $work->content) }}</textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-title">video URL</div>
                            <input type="text" name="video" value="{{ old('video', $work->video) }}">
                        </div>
                        <div class="input-group">
                            <div class="input-title">thumbnail url</div>
                            <input type="url" name="thumbnail" placeholder="https://i.imgur.com/xxxxx.jpg" value="{{ old('thumbnail', $work->thumbnail) }}" required>
                            <small style="color: #666; font-size: 12px;">Upload to Imgur/ImgBB and paste URL here</small>
                            @if($work->thumbnail)
                                <div style="margin-top: 10px;">
                                    <img src="{{ $work->thumbnail }}" alt="Current thumbnail" style="max-width: 200px; display: block;">
                                    <small style="display: block; margin-top: 5px; color: #999;">Current URL: {{ $work->thumbnail }}</small>
                                </div>
                            @endif
                        </div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/form-autosave.js') }}"></script>
</html>
