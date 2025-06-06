<nav>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('etudiants') }}">About</a></li>
    </ul>
    {{ $slot }}
</nav>