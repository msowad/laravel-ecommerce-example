<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
    <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">

        <h1 class="mb-0 mdc-typography--headline6">{{ $title }} From :</h1>
        <input wire:model="{{ $from }}" class="mdc-text-field__input" type="date" id="text-field-hero-input">

        <h1 class="mb-0 mdc-typography--headline6">To :</h1>
        <input wire:model="{{ $to }}" class="mdc-text-field__input" type="date" id="text-field-hero-input">

        <div class="mdc-notched-outline mdc-notched-outline--upgraded">
            <div class="mdc-notched-outline__leading"></div>
            <div class="mdc-notched-outline__trailing"></div>
        </div>
    </div>
</div>
