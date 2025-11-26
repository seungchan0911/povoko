<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>povoko studio</title>
    <link rel="shortcut icon" href="{{ asset("img/source/favicon.png") }}" type="image/x-icon">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
</head>
<body data-page="works">
    <!-- 로딩 애니메이션 -->
    <div class="loading-screen">
        <div class="loading-text">0%</div>
    </div>
    
    <div class="container">
        <x-layout.header />
        <main data-scroll-container>
            <section class="film-section">
                <div class="fixed-film-shuck" data-scroll data-scroll-sticky data-scroll-target=".film-section">
                    <div class="fixed-film">
                        <div class="film-wrap">
                            <iframe src="{{ $works->first()?->video ?? '' }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" allowfullscreen></iframe>
                        </div>
                        <div class="text-group">
                            <div class="text-01">{{ $works->first()?->title ?? 'Brand Film for @brandname' }}</div>
                            <div class="read-more"><a href="{{ $works->first() ? route('works.show', $works->first()->id) : '#' }}" data-work-id="{{ $works->first()?->id ?? '' }}">Read more...</a></div>
                        </div>
                    </div>
                </div>
                <div class="film-scroll">
                    <div class="film-grid">
                        @foreach ($works as $work)
                        <div class="film" data-video="{{ $work->video }}" data-title="{{ $work->title }}" data-content="{{ $work->content }}" data-work-id="{{ $work->id }}">
                            <img src="{{ $work->thumbnail }}" alt="{{ $work->title }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="./js/main.js"></script>
</html>
