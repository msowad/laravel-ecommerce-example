@if ($editId == '')
    @section($that . '-add')
        active
    @endsection
@endif
@section('title')
    Edit {{ $thatUp }}
@endsection
<div class="">
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">

                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">
                            Edit User
                        </h6>
                        <a href="{{ route('dashboard.' . $that) }}" class="">All</a>
                    </div>
                    <div class="template-demo">
                        <form wire:submit.prevent='submit'>

                            <div class="mdc-layout-grid__inner">

                                <x-m-input required name="name" span=6 />
                                <x-m-input name="mobile" type="tel" label="mobile" span="6" />
                                <x-m-input required name="email" type="email" />
                                <x-m-input name="address" />
                                <x-m-input name="city" />
                                <x-m-input name="state" />
                                <x-m-input name="zip" />
                                <x-m-input name="company" />

                                <div
                                    class="mdc-layout-grid__cell mdc-layout-grid__cell--span-9-desktop align-self-center">
                                    @forelse ($roles as $role)
                                        <x-chips onClick="selectRole('{{ $role->id }}')" label="{{ $role->name }}"
                                            onDelete="deleteRole('{{ $role->id }}')" />
                                    @empty
                                        <h1 class="mdc-typography--subtitle2">No Role</h1>
                                    @endforelse
                                </div>
                                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" wire:model.defer="new_role" id="role">
                                        <div class="mdc-line-ripple"></div>
                                        <label for="role"
                                            class="mdc-floating-label {{ $new_role != null ? 'mdc-floating-label--float-above' : '' }}">New
                                            Role
                                        </label>
                                        <button type="button" wire:click="createNewRole" class="mdc-icon-button btn-responsive
                                            material-icons">add</button>
                                    </div>
                                    @error('new_role')

                                        <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                @foreach ($allPermissions as $allPermission)
                                    <x-mdc-checkbox labelFromValue name="permissions" value="{{ $allPermission }}"
                                        span="3" />
                                @endforeach

                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                    <button class="tup mdc-button mdc-button--raised mdc-ripple-upgraded w-100">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('admin.progress-indicator')
                </div>
            </div>
        </div>
    </div>
</div>
