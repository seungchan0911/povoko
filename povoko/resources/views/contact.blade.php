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
            <section class="contact">
              <div class="logo">povoko studio</div>
              <form action="" method="POST">
                @csrf
                <div class="inputs">
                  <div class="input-group">
                    <div class="input-title">Name(*)</div>
                    <input type="text">
                  </div>
                  <div class="input-group">
                    <div class="input-title">E-mail(*)</div>
                    <input type="text">
                  </div>
                  <div class="input-group">
                    <div class="input-title">Message</div>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                  </div>
                  <button type="submit">Send</button>
                </form>
              </div>
              <div class="contact"></div>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="./js/main.js"></script>
</html>