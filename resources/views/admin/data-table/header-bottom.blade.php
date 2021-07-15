<div class="d-flex justify-content-between px-4">
    <div class="">
        <div class="mdc-text-field mdc-text-field--outlined align-items-center px-2">
            <i class="material-icons" style="width:30px;">table_rows</i>
            <input style="width: 55px;padding:13px 0px;" wire:model="perPage" class="mdc-text-field__input" min="0"
                step="10" type="number">
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <button id="filterToggle" aria-describedby="tt_filter" class="mdc-icon-button material-icons">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black"
                width="18px" height="18px">
                <g>
                    <path d="M0,0h24v24H0V0z" fill="none" />
                </g>
                <g>
                    <path
                        d="M4.21,5.61C6.23,8.2,10,13,10,13v5c0,1.1,0.9,2,2,2h0c1.1,0,2-0.9,2-2v-5c0,0,3.77-4.8,5.79-7.39C20.3,4.95,19.83,4,19,4H5 C4.17,4,3.7,4.95,4.21,5.61z" />
                </g>
            </svg>
        </button>

        <div id="tt_filter" class="mdc-tooltip" role="tooltip" aria-hidden="true">
            <div class="mdc-tooltip__surface">
                Filter Table
            </div>
        </div>
        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
            <i class="material-icons mdc-text-field__icon">search</i>
            <input class="mdc-text-field__input" wire:model="search" type="search" id="text-field-hero-input">
            <div class="mdc-notched-outline">
                <div class="mdc-notched-outline__leading"></div>
                <div class="mdc-notched-outline__trailing"></div>
            </div>
        </div>
    </div>
</div>
