<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>povoko studio</title>
    <link rel="shortcut icon" href="./img/source/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
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
                <div class="fixed-film">
                    @auth('admin')
                    <div class="delete-button-container">
                        <form action="{{ route('admin.works.delete', $work->id) }}" method="POST" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">삭제</button>
                        </form>
                    </div>
                    @endauth
                    
                    <div class="film-wrap work-detail">
                        <iframe class="detail-iframe" src="{{ $work->video }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" allowfullscreen></iframe>
                    </div>
                    <div class="text-group">
                        <div class="text-01">{{ $work->title }}</div>
                        <div class="read-more-content">{!! nl2br(e($work->content)) !!}</div>
                    </div>
                </div>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>
