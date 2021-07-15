<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
    <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">

        <h1 class="mb-0 mdc-typography--headline6">Added On From :</h1>
        <input wire:model="addedOnFrom" class="mdc-text-field__input" type="date" id="text-field-hero-input">

        <h1 class="mb-0 mdc-typography--headline6">To :</h1>
        <input wire:model="addedOnTo" class="mdc-text-field__input" type="date" id="text-field-hero-input">

        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
            <div class="mdc-notched-outline__leading"></div>
            <div class="mdc-notched-outline__trailing"></div>
        </div>
    </div>
</div>

@if ($onlyTrashed == 'true')
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
        <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">
            <h1 class="mb-0 mdc-typography--headline6">Deleted At From :</h1>
            <input wire:model="deletedAtFrom" class="mdc-text-field__input" type="date" id="text-field-hero-input">
            <h1 class="mb-0 mdc-typography--headline6">To :</h1>
            <input wire:model="deletedAtTo" class="mdc-text-field__input" type="date" id="text-field-hero-input">
            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
    </div>
@endif
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
    <div class="d-flex align-items-center">
        Status
        <div class="mdc-form-field ml-2">
            <div class="mdc-radio">
                <input wire:model="status" value="activated" class="mdc-radio__native-control" type="radio"
                    id="activated" name="radios">
                <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
            </div>
            <label for="activated">Activated</label>
        </div>
        <div class="mdc-form-field">
            <div class="mdc-radio">
                <input wire:model="status" value="deactivated" class="mdc-radio__native-control" type="radio"
                    id="deactivated" name="radios">
                <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
            </div>
            <label for="deactivated">Deactivated</label>
        </div>
        <div class="mdc-form-field">
            <div class="mdc-radio">
                <input wire:model="status" value="" class="mdc-radio__native-control" type="radio" id="all"
                    name="radios">
                <div class="mdc-radio__background">
                    <div class="mdc-radio__outer-circle"></div>
                    <div class="mdc-radio__inner-circle"></div>
                </div>
                <div class="mdc-radio__ripple"></div>
            </div>
            <label for="all">All</label>
        </div>
    </div>
</div>
