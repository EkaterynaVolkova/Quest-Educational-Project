<nav class="nav1">
    <ul class="ul1">
        <li class="active"><a href="/public/" class="a1">Home</a></li>
        @if (Auth::check())
            <li><a class="a1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> Logout </a></li>
        @else
            <li><a href="/public/login" class="a1">Login</a></li>
        @endif
        @if (Auth::check())
            <?php echo '<li><a href="/public/users/profile" class="a1">Profile</a></li>'; ?>
        @endif
        <li><a href="/public/contact-form" class="a1">Contacts</a></li>
    </ul>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
