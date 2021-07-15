<li><a href="{{ route('logout') }}" class="mdc-button mdc-button--raised mdc-button--white text-uppercase"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt mr-3"></i>Logout
    </a></li>

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>
