@if ($search != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">search:"{{ $search }}"</span>
                <button wire:click="clear('search')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
@if ($addedOnFrom != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">added on from:"{{ $addedOnFrom }}"</span>
                <button wire:click="clear('addedOnFrom')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
@if ($addedOnTo != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">added on to:"{{ $addedOnTo }}"</span>
                <button wire:click="clear('addedOnTo')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
@if ($deletedAtFrom != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">deleted at from:"{{ $deletedAtFrom }}"</span>
                <button wire:click="clear('deletedAtFrom')"
                    class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
@if ($deletedAtTo != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">deleted at to:"{{ $deletedAtTo }}"</span>
                <button wire:click="clear('deletedAtTo')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
@if ($status != '')
    <div class="mdc-chip mdc-chip--touch">
        <div class="mdc-chip__ripple"></div>
        <span role="gridcell">
            <span role="button" tabindex="0" class="mdc-chip__primary-action">
                <div class="mdc-chip__touch"></div>
                <span class="mdc-chip__text">status:"{{ $status }}"</span>
                <button wire:click="clear('status')" class="btn-chip mdc-icon-button material-icons">close</button>
            </span>
        </span>
    </div>
@endif
