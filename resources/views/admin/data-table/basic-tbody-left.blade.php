<td class="pl-1 w-0 mdc-data-table__cell mdc-data-table__cell--checkbox">
    <div class="mdc-form-field">
        <div class="mdc-checkbox">
            <input wire:model='selected' value="{{ $item->id }}" type="checkbox" class="mdc-checkbox__native-control"
                id="checkbox-{{ $item->id }}" />
            <div class="mdc-checkbox__background">
                <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                    <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                </svg>
                <div class="mdc-checkbox__mixedmark"></div>
            </div>
        </div>
    </div>
</td>
<td class="mdc-data-table__cell ">
    {{ $item->id }}
</td>
