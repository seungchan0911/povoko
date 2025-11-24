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
    <div class="container">
        <x-layout.header />
        <main data-scroll-container>
            <section class="contact">
              <div class="logo">povoko studio</div>
              <form action="{{ route('contact') }}" method="POST" data-autosave="contact-form">
                @csrf
                <div class="inputs">
                  <div class="input-group">
                    <div class="input-title">Name(*)</div>
                    <input type="text" name="name" required>
                  </div>
                  <div class="input-group">
                    <div class="input-title">E-mail(*)</div>
                    <input type="email" name="email" required>
                  </div>
                  <div class="input-group">
                    <div class="input-title">Message</div>
                    <textarea name="message" id="" cols="30" rows="10" required></textarea>
                  </div>
                  <button type="submit">Send</button>
                </form>
              </div>
              <div class="contact-content">
                <ul>
                  <li><a href="https://www.instagram.com/povoko_studio" target="_blank">@@povoko_studio</a></li>
                  <li><a href="#">+82 10 6326 9088</a></li>
                  <li><a href="#">+33 7 67 05 93 11</a></li>
                  <li><a href="mailto:contact@povokostudio.com">contact@povokostudio.com</a></li>
                </ul>
              </div>
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="./js/main.js"></script>
<script src="./js/form-autosave.js"></script>
@if (session('success'))
<script>
    alert(@json(session('success')));
    // 성공 시 로컬스토리지 클리어
    localStorage.removeItem('form_contact-form');
</script>
@endif
</html>