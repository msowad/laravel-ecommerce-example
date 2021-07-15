@if ($value != $defaultVal)

    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">{{ $label }}:"{{ $value }}"</span>
                <button wire:click="clear('{{ $func }}')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
