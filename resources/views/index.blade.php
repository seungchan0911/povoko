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
<body data-page="home">
    <!-- 로딩 애니메이션 -->
    <div class="loading-screen">
        <div class="loading-text">0%</div>
    </div>
    
    <div class="container">
        <x-layout.header />
        <main data-scroll-container>
            <section class="section-01" data-scroll-section>
                <div class="logo" data-scroll data-scroll-speed="3">povoko studio</div>
            </section>
            <section class="section-02" data-scroll-section>
                @php
                    $videos = [
                        $text->background_video_1 ? asset('storage/' . $text->background_video_1) : null,
                        $text->background_video_2 ? asset('storage/' . $text->background_video_2) : null,
                        $text->background_video_3 ? asset('storage/' . $text->background_video_3) : null,
                        $text->background_video_4 ? asset('storage/' . $text->background_video_4) : null,
                    ];
                    $videos = array_filter($videos);
                    $videos = array_values($videos);
                @endphp
                
                <div class="bg-parallax">
                    @if(isset($videos[0]))
                    <video autoplay muted loop playsinline src="{{ $videos[0] }}"></video>
                    @endif
                    @if(isset($videos[1]))
                    <video autoplay muted loop playsinline src="{{ $videos[1] }}"></video>
                    @endif
                    @if(isset($videos[2]))
                    <video autoplay muted loop playsinline src="{{ $videos[2] }}"></video>
                    @endif
                    @if(isset($videos[3]))
                    <video autoplay muted loop playsinline src="{{ $videos[3] }}"></video>
                    @endif
                </div>
                
                <div class="text-content-shuck" data-scroll data-scroll-sticky data-scroll-target=".section-02">
                    <div class="text-content">
                        <div class="text-01">{!! nl2br(e($text->text1)) !!}</div>
                        <ul class="text-group">
                            <li class="logo">povoko studio</li>
                            <li>{!! nl2br(e($text->text2)) !!}</li>
                        </ul>
                    </div>
                </div>
            </section>
            {{-- <section class="section-03 film-section" data-scroll>
                <img src="https://images.unsplash.com/photo-1640267461512-38f3f6b1b102?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" data-scroll data-scroll-speed="1">
                <div class="text-content" data-scroll data-scroll-speed="0">
                    <div class="text-01">Brand Film for @@brandname</div>
                    <ul class="text-group">
                        <li>Creative Direction — Brand Studio  </li>
                        <li>Photographer ——— Firstname Lastname @@photographer.handle  </li>
                        <li>Production @@production_studio  </li>
                        <li>Director & Editor @@director.handle</li>
                    </ul>
                </div>
            </section>
            <section class="section-04 film-section" data-scroll>
                <img src="https://images.unsplash.com/photo-1530177150700-84cd9a3b059b?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" data-scroll data-scroll-speed="1">
                <div class="text-content" data-scroll data-scroll-speed="0">
                    <div class="text-01">Brand Film for @@brandname</div>
                    <ul class="text-group">
                        <li>Creative Direction — Brand Studio  </li>
                        <li>Photographer ——— Firstname Lastname @@photographer.handle  </li>
                        <li>Production @@production_studio  </li>
                        <li>Director & Editor @@director.handle</li>
                    </ul>
                </div>
            </section>
            <section class="section-05 film-section" data-scroll>
                <img src="https://images.unsplash.com/photo-1753357782092-b2cd31f56ff7?q=80&w=2075&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" data-scroll data-scroll-speed="1">
                <div class="text-content" data-scroll data-scroll-speed="0">
                    <div class="text-01">Brand Film for @@brandname</div>
                    <ul class="text-group">
                        <li>Creative Direction — Brand Studio  </li>
                        <li>Photographer ——— Firstname Lastname @@photographer.handle  </li>
                        <li>Production @@production_studio  </li>
                        <li>Director & Editor @@director.handle</li>
                    </ul>
                </div>
            </section> --}}
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="./js/main.js"></script>
</html>