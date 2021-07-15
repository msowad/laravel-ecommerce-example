<a class="border-0 d-flex text-dark mdc-list-item" href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <div class="item-thumbnail item-thumbnail-icon-only">
        <i class="mdi mdi-logout text-primary"></i>
    </div>
    <div class="item-content d-flex align-items-start flex-column justify-content-center">
        <h6 class="item-subject font-weight-normal">Logout</h6>
    </div>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>
