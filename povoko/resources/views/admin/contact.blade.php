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
            <section class="messages" data-scroll>
                <a href="{{ route('admin.index') }}">Back</a>
                Page: {{ $contacts->currentPage() }}
                @foreach ($contacts as $contact)
                <div class="message">
                    <div class="top">
                        <div class="left">
                            <div class="number">{{ $contact->id }}</div>|
                            <div class="name">{{ $contact->name }}</div>|
                            <div class="email">{{ $contact->email }}</div>
                        </div>
                        <div class="right">
                            <div class="date">{{ $contact->created_at->format('Y. m. d.') }}</div>|
                            <form action="{{ route('admin.contact.delete', $contact->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('정말 삭제하시겠습니까?')" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; padding: 0; text-decoration: underline;">delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="content">{!! nl2br(e($contact->message)) !!}</div>
                    </div>
                </div>
                @endforeach
                {{ $contacts->links() }}
            </section>
        </main>
        <footer></footer>
    </div>
</body> 
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>