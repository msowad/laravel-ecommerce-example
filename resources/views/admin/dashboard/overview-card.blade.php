<div
    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
    <div aria-describedby="tt_overview_card_{{ $key }}" class="mdc-card overview-card info-card info-card--{{ $type }}">
        <div class="card-inner">
            <h5 class="card-title">{{ $label }}</h5>
            <h5 class="font-weight-light pb-2 mb-1">{{ $value }}</h5>
            <div class="card-icon-wrapper">
                <i class="material-icons">{{ $logo }}</i>
            </div>
        </div>
    </div>
    <div id="tt_overview_card_{{ $key }}" class="mdc-tooltip" role="tooltip" aria-hidden="true">
        <div class="mdc-tooltip__surface">
            {{ $tooltip }}
        </div>
    </div>
</div>
