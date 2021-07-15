<div class="mdc-list-item mdc-drawer-item">
    <button class="mdc-expansion-panel-link w-100 btn-transparent" data-toggle="expansionPanel"
        data-target="{{ $rand }}">
        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">{{ $icon }}</i>
        {{ $label }}
        <i class="mdc-drawer-arrow material-icons">chevron_right</i>
    </button>
    <div class="mdc-expansion-panel" id="{{ $rand }}">
        <nav class="mdc-list mdc-drawer-submenu">
            {{ $slot }}
        </nav>
    </div>
</div>
