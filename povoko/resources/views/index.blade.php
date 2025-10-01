<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>povoko studio</title>
    <link rel="shortcut icon" href="./img/source/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css">
</head>
<body data-page="home">
    <div class="container">
        <x-layout.header />
        <main data-scroll-container>
            <section class="section-01">
                <div class="logo" data-scroll data-scroll-speed="3">povoko studio</div>
            </section>
            <section class="section-02" data-scroll>
                <div class="bg-parallax" data-scroll data-scroll-speed="-2"></div>
                <div class="text-content" data-scroll data-scroll-speed="3">
                    <div class="text-01">We make visuals for your brand.<br>----- fr(seoul) (london) (paris) (tokyo) -----</div>
                    <ul class="text-group">
                        <li class="logo">povoko studio</li>
                        <li>
                            is a global creative production based in Seoul<br>
                            and Europe, providing integrated visual solutions for brands.
                        </li>
                    </ul>
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