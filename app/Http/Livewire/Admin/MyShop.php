<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyShop extends Component
{
    use WithFileUploads;

    public $name;
    public $short_description;
    public $mobile1;
    public $mobile2;
    public $mail1;
    public $mail2;
    public $address;
    public $map;
    public $youtube;
    public $facebook;
    public $twitter;
    public $instagram;
    public $linkedin;
    public $google_plus;
    public $logo_primary;
    public $logo_secondary;
    public $favicon;
    public $timezone;
    public $timezones;

    public $logoPrimaryPreview;
    public $logoSecondaryPreview;
    public $faviconPreview;

    public $myShop;

    public function photoValidation($attribute, $value, $fail)
    {
        if (method_exists($value, 'getMimeType')) {
            if (!in_array($value->extension(), ["jpeg", "png", "jpg", "svg", "ico"])) {
                $attribute = str_replace('_', ' ', $attribute);
                return $fail('The ' . $attribute . ' must be a file of type: jpeg, jpg, png.');
            }
        }
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name'              => 'required',
            'short_description' => 'required',
            'mobile1'           => 'required',
            'mobile2'           => '',
            'mail1'             => 'required|email',
            'mail2'             => 'nullable|email',
            'address'           => 'required',
            'map'               => 'required',
            'timezone'          => ['nullable', Rule::in($this->timezones)],
            'youtube'           => 'nullable|url',
            'facebook'          => 'nullable|url',
            'twitter'           => 'nullable|url',
            'instagram'         => 'nullable|url',
            'linkedin'          => 'nullable|url',
            'google_plus'       => 'nullable|url',
            'logo_primary'      => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'logo_secondary'    => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'favicon'           => 'nullable|mimes:jpeg,png,jpg,svg,ico',
        ]);

        $media = MediaController::set('logo_primary', $validatedData['logo_primary'], 'My Shop', 'logo_primary');
        $media?->replace(1);
        unset($validatedData['logo_primary']);

        $media = MediaController::set('logo_secondary', $validatedData['logo_secondary'], 'My Shop', 'logo_secondary');
        $media?->replace(1);
        unset($validatedData['logo_secondary']);

        $media = MediaController::set('favicon', $validatedData['favicon'], 'My Shop', 'favicon');
        $media?->replace(1);
        unset($validatedData['favicon']);

        if (can('manage my shop')) {
            if ($this->myShop) {
                $this->myShop->update($validatedData);
            } else {
                \App\Models\MyShop::create($validatedData);
            }
        }

        Cache::forget('app.info');

        session()->flash('success_msg', 'Shop details saved');
    }

    public function mount()
    {
        $this->timezone  = config('app.timezone');
        $this->timezones = timezone_identifiers_list();

        $this->myShop = \App\Models\MyShop::with(['logoPrimary', 'logoSecondary', 'favicon'])->first();
        if ($this->myShop) {
            $this->name                 = $this->myShop->name;
            $this->short_description    = $this->myShop->short_description;
            $this->mobile1              = $this->myShop->mobile1;
            $this->mobile2              = $this->myShop->mobile2;
            $this->mail1                = $this->myShop->mail1;
            $this->mail2                = $this->myShop->mail2;
            $this->address              = $this->myShop->address;
            $this->map                  = $this->myShop->map;
            $this->youtube              = $this->myShop->youtube;
            $this->facebook             = $this->myShop->facebook;
            $this->twitter              = $this->myShop->twitter;
            $this->instagram            = $this->myShop->instagram;
            $this->linkedin             = $this->myShop->linkedin;
            $this->google_plus          = $this->myShop->google_plus;
            $this->logoPrimaryPreview   = $this->myShop->logoPrimary->url;
            $this->logoSecondaryPreview = $this->myShop->logoSecondary->url;
            $this->faviconPreview       = $this->myShop->favicon->url;
            $this->timezone             = $this->myShop->timezone;
        }
    }

    public function render()
    {
        return view('livewire.admin.my-shop')
            ->layout('layouts.admin');
    }
}
