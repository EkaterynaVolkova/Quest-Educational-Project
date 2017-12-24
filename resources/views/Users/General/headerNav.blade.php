<nav>
    <ul class="nav">
        <li class="active"><a href="/public/">Home</a></li>
        <li><a href="/public/login">Login</a></li>
        @if (Auth::check())
        <?php echo '<li><a href="/public/users/profile">Profile</a></li>'; ?>
        @endif
        <li><a href="#">Contacts</a></li>
    </ul>
</nav>