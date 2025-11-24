<img class="background-image" src="{{ asset('img/source/background.png') }}" alt="">
<header>
    <input type="checkbox" id="remote" hidden>
    <label for="remote"><div class="remote">
    <svg width="34" height="24" viewBox="0 0 34 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_314_11)">
    <rect width="34" height="1.25" fill="black"/>
    <rect width="34" height="1.25" transform="translate(0 11.375)" fill="black"/>
    <rect width="34" height="1.25" transform="translate(0 22.75)" fill="black"/>
    </g>
    <defs>
    <clipPath id="clip0_314_11">
    <rect width="34" height="24" fill="white"/>
    </clipPath>
    </defs>
    </svg>
    </div></label>
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