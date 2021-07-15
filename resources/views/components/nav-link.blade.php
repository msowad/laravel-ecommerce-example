@can($can)
    <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link" href="{{ route($route) }}">
            @if ($icon)
                <i style="width: 18px;" class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon"
                    aria-hidden="true">{{ $icon }}</i>
            @endif
            {{ $label }}
        </a>
    </div>
@endcan
