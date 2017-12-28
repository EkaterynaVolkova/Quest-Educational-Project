<nav class="nav1">
    <ul class="ul1">
        <li class="active"><a href="/public/" class="a1">Home</a></li>
        <li><a href="/public/login" class="a1">Login</a></li>
        @if (Auth::check())
        <?php echo '<li><a href="/public/users/profile" class="a1">Profile</a></li>'; ?>
        @endif
        <li><a href="/public/contact-form" class="a1">Contacts</a></li>
    </ul>
</nav>