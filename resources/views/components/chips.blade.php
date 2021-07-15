<div class="mdc-chip mdc-chip--touch" wire:ignore>
    <div class="mdc-chip__ripple"></div>
    <span role="gridcell">
        <span role="button" tabindex="0" class="mdc-chip__primary-action">
            <div class="mdc-chip__touch"></div>
            <span @if ($onClick) wire:click="{{ $onClick }}" @endif class="mdc-chip__text">{{ $label }}</span>
            <button type="button" @if ($onDelete) wire:click="{{ $onDelete }}" @endif
                class="btn-chip mdc-icon-button material-icons">close</button>
        </span>
    </span>
</div>
