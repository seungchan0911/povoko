<img class="background-image" src="{{ asset('img/source/background.png') }}" alt="">
<header>
    <input type="checkbox" id="remote" hidden>
    <label for="remote"><div class="remote">pv<br>ko</div></label>
</header>
<div class="remote-display">
    <ul>
        <li>
            <a href="{{ route('index') }}">home</a>
        </li>
        <li>
            <a href="{{ route('works') }}">works</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">contact</a>
        </li>
    </ul>
    <div class="remote-admin">
        @if(Auth::guard('admin')->check())
            <a href="{{ route('admin.index') }}">Go to Admin Panel</a>
        @else
            <a href="{{ route('admin') }}">Are you an administrator?</a>
        @endif
    </div>
</div>