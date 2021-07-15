@section('my-shop')
  active
@endsection

@section('title')
  My Shop
@endsection

<div class="">
  <div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner">
      <div class="mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
          <h6 class="card-title">
            My Shop
          </h6>
          <div class="template-demo">
            <form wire:submit.prevent='submit'>

              <div class="mdc-layout-grid__inner">

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='name' id="name">
                    <div class="mdc-line-ripple"></div>
                    <label for="name"
                      class="mdc-floating-label {{ $name != '' ? 'mdc-floating-label--float-above' : '' }}">Name<span
                        class="text-danger">*</span></label>
                  </div>
                  @error('name')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div
                  class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('short_description') input-invalid @enderror">
                  <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea">
                    <span
                      class="mdc-floating-label {{ $short_description != '' ? 'mdc-floating-label--float-above' : '' }}"
                      id="short_description">Short Description<span class="text-danger">*</span></span>
                    <span class="mdc-text-field__ripple"></span>
                    <textarea wire:model.defer="short_description" class="mdc-text-field__input"
                      aria-labelledby="short_description" rows="2" cols="120">{{ $short_description }}</textarea>
                    <span class="mdc-line-ripple"></span>

                  </label>

                  @error('short_description')

                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='mobile1' id="mobile1">
                    <div class="mdc-line-ripple"></div>
                    <label for="mobile1"
                      class="mdc-floating-label {{ $mobile1 != '' ? 'mdc-floating-label--float-above' : '' }}">Mobile<span
                        class="text-danger">*</span></label>
                  </div>
                  @error('mobile1')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='mobile2' id="mobile2">
                    <div class="mdc-line-ripple"></div>
                    <label for="mobile2"
                      class="mdc-floating-label {{ $mobile2 != '' ? 'mdc-floating-label--float-above' : '' }}">Mobile</label>
                  </div>
                  @error('mobile2')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='mail1' id="mail1">
                    <div class="mdc-line-ripple"></div>
                    <label for="mail1"
                      class="mdc-floating-label {{ $mail1 != '' ? 'mdc-floating-label--float-above' : '' }}">Mail<span
                        class="text-danger">*</span></label>
                  </div>
                  @error('mail1')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='mail2' id="mail2">
                    <div class="mdc-line-ripple"></div>
                    <label for="mail2"
                      class="mdc-floating-label {{ $mail2 != '' ? 'mdc-floating-label--float-above' : '' }}">Mail</label>
                  </div>
                  @error('mail2')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div
                  class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('address') input-invalid @enderror">
                  <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea">
                    <span class="mdc-floating-label {{ $address != '' ? 'mdc-floating-label--float-above' : '' }}"
                      id="address">Address<span class="text-danger">*</span></span>
                    <span class="mdc-text-field__ripple"></span>
                    <textarea wire:model.defer="address" class="mdc-text-field__input" aria-labelledby="address"
                      rows="2" cols="120">{{ $address }}</textarea>
                    <span class="mdc-line-ripple"></span>

                  </label>

                  @error('address')

                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div
                  class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop text-area-filled @error('map') input-invalid @enderror">
                  <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea">
                    <span class="mdc-floating-label {{ $map != '' ? 'mdc-floating-label--float-above' : '' }}"
                      id="map">map<span class="text-danger">*</span></span>
                    <span class="mdc-text-field__ripple"></span>
                    <textarea wire:model.defer="map" class="mdc-text-field__input" aria-labelledby="map" rows="2"
                      cols="120">{{ $map }}</textarea>
                    <span class="mdc-line-ripple"></span>

                  </label>

                  @error('map')

                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                  <div class="mdc-text-field">
                    <select wire:model.defer='timezone' class="mdc-text-field__input" id="timezone">
                      <option value="0">

                      </option>
                      @foreach ($timezones as $timezoneDt)
                        <option {{ $timezoneDt == $timezone ? 'selected' : '' }} value="{{ $timezoneDt }}">
                          {{ $timezoneDt }}
                        </option>
                      @endforeach
                    </select>
                    <div class="mdc-line-ripple"></div>
                    <label for="timezone" class="mdc-floating-label mdc-floating-label--float-above">Timezone</label>
                  </div>
                  @error('timezone')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='youtube' id="youtube">
                    <div class="mdc-line-ripple"></div>
                    <label for="youtube"
                      class="mdc-floating-label {{ $youtube != '' ? 'mdc-floating-label--float-above' : '' }}">Youtube</label>
                  </div>
                  @error('youtube')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='facebook' id="facebook">
                    <div class="mdc-line-ripple"></div>
                    <label for="facebook"
                      class="mdc-floating-label {{ $facebook != '' ? 'mdc-floating-label--float-above' : '' }}">Facebook</label>
                  </div>
                  @error('facebook')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='twitter' id="twitter">
                    <div class="mdc-line-ripple"></div>
                    <label for="twitter"
                      class="mdc-floating-label {{ $twitter != '' ? 'mdc-floating-label--float-above' : '' }}">Twitter</label>
                  </div>
                  @error('twitter')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='instagram' id="instagram">
                    <div class="mdc-line-ripple"></div>
                    <label for="instagram"
                      class="mdc-floating-label {{ $instagram != '' ? 'mdc-floating-label--float-above' : '' }}">Instagram</label>
                  </div>
                  @error('instagram')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='linkedin' id="linkedin">
                    <div class="mdc-line-ripple"></div>
                    <label for="linkedin"
                      class="mdc-floating-label {{ $linkedin != '' ? 'mdc-floating-label--float-above' : '' }}">Linkedin</label>
                  </div>
                  @error('linkedin')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>
                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                  <div class="mdc-text-field">
                    <input class="mdc-text-field__input" wire:model.defer='google_plus' id="google_plus">
                    <div class="mdc-line-ripple"></div>
                    <label for="google_plus"
                      class="mdc-floating-label {{ $google_plus != '' ? 'mdc-floating-label--float-above' : '' }}">Google
                      Plus</label>
                  </div>
                  @error('google_plus')
                    <div class="mdc-layout-grid__cell ml-3 mdc-layout-grid__cell--span-12">
                      <p class="text-danger">{{ $message }}</p>
                    </div>
                  @enderror
                </div>

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                  <input wire:loading.attr='disabled' type="file" wire:target='logo_primary' class="d-none"
                    wire:model='logo_primary' id="logo_primary">
                  <label for="logo_primary" wire:loading.class='disabled' wire:target='logo_primary'
                    class="mdc-button mdc-button--unelevated filled-button--success mdc-ripple-upgraded text-uppercase w-100 py-4">
                    primary logo</label>
                </div>

                @if ($logo_primary)
                  @if ($logoPrimaryPreview == '')
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                    <img src="{{ $logo_primary->temporaryUrl() }}" alt="" width="100%">
                  </div>
                  @if ($logoPrimaryPreview == '')
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                @endif


                @if ($logoPrimaryPreview != '')
                  @if (!$logo_primary)
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                    <p class="text-uppercase text-dark text-center bg-light mx-0 mt-0 mb-2 py-2">
                      Previous
                      Photo</p>
                    <img src="{{ $logoPrimaryPreview }}" alt="" width="100%">
                  </div>
                  @if (!$logo_primary)
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                @endif

                @error('logo_primary')
                  <div class="text-center bg-danger mx-0 py-2 mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                    <p class="text-light m-0">{{ $message }}</p>
                  </div>
                @enderror

                <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                  <input wire:loading.attr='disabled' type="file" wire:target='logo_secondary' class="d-none"
                    wire:model='logo_secondary' id="logo_secondary">
                  <label for="logo_secondary" wire:loading.class='disabled' wire:target='logo_secondary'
                    class="mdc-button mdc-button--unelevated filled-button--dark mdc-ripple-upgraded text-uppercase w-100 py-4">
                    Secondary logo</label>
                </div>

                @if ($logo_secondary)
                  @if ($logoSecondaryPreview == '')
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                    <img src="{{ $logo_secondary->temporaryUrl() }}" alt="" width="100%">
                  </div>
                  @if ($logoSecondaryPreview == '')
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                @endif

                @if ($logoSecondaryPreview != '')
                  @if (!$logo_secondary)
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                    <p class="text-uppercase text-dark text-center bg-light mx-0 mt-0 mb-2 py-2">
                      Previous
                      Photo</p>
                    <img src="{{ $logoSecondaryPreview }}" alt="" width="100%">
                  </div>
                  @if (!$logo_secondary)
                    <div class="mdc-layout-grid__cell--span-3-desktop"></div>
                  @endif
                @endif

                @error('logo_secondary')
                  <div class="text-center bg-danger mx-0 py-2 mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                    <p class="text-light m-0">{{ $message }}</p>
                  </div>
                @enderror


                <div class="d-flex align-items-center mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                  <h3 class="mr-3">Fabicon</h3> <input wire:loading.attr='disabled' type="file" wire:target='favicon'
                    wire:model='favicon' class="image-input" id="favicon">
                </div>
                @if ($faviconPreview != '')
                  <div class="mdc-layout-grid__cell--span-5-desktop"></div>
                  <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop">
                    <p class="text-uppercase text-dark text-center bg-light mx-0 mt-0 mb-2 py-2">
                      Previous
                      Photo</p>
                    <img src="{{ $faviconPreview }}" alt="" width="100%">
                  </div>
                  <div class="mdc-layout-grid__cell--span-5-desktop"></div>
                @endif

                @error('favicon')
                  <div class="text-center bg-danger mx-0 py-2 mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                    <p class="text-light m-0">{{ $message }}</p>
                  </div>
                @enderror
                @if ($favicon)
                  <div class="text-center bg-success mx-0 py-2 mdc-layout-grid__cell mdc-layout-grid__cell--span-12">
                    <p class="text-light m-0">Save and relad to see changes</p>
                  </div>
                @endif

                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                  <button wire:loading.attr='disabled' id="submitBtn"
                    class="mdc-button mdc-button--raised mdc-ripple-upgraded w-100 text-uppercase">
                    Save
                  </button>
                </div>
              </div>
            </form>
          </div>
          @include('admin.progress-indicator')
          @if (session()->has('success_msg'))
            <p class="mt-2 p-1 text-center text-uppercase bg-success text-light">
              {{ session('success_msg') }}
            </p>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
