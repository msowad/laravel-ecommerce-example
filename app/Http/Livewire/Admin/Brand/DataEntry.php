<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Http\Controllers\MediaController;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataEntry extends Component
{
    use WithFileUploads;

    public $that   = 'brand';
    public $thatUp = 'Brand';
    public $editId = '';

    public $name;
    public $slug;
    public $photo;
    public $in_home_page;
    public $brand;

    public $photoPreview = '';

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->validate(['photo' => 'image|mimes:jpeg,jpg,png']);
        }
    }

    public function submit()
    {
        $this->slug = '' != $this->slug ? Str::slug($this->slug) : Str::slug($this->name);

        $validationArr = '' != $this->editId ? [
            'name' => ['required', Rule::unique('brands')->ignore($this->editId)],
            'slug' => ['required', Rule::unique('brands')->ignore($this->editId)],
        ]
        : [
            'name' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
        ];

        if ($this->photo) {
            $validationArr = array_merge($validationArr, ['photo' => 'image|mimes:jpeg,jpg,png']);
        }

        $this->validate($validationArr);

        $media = MediaController::set(Brand::class, $this->photo, 'brand', $this->slug);

        $form = [
            'name'         => $this->name,
            'slug'         => $this->slug,
            'in_home_page' => $this->in_home_page,
        ];

        $status = "added";

        if ('' != $this->editId && $this->brand && can('edit brand')) {
            $media?->replace($this->editId);

            $this->brand->update($form);
            $status = "updated";
        } else if (can('add brand')) {
            $brand = Brand::create($form);
            $media?->upload($brand->id);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->brand        = Brand::with('photo')->where('id', $id)->firstOrFail();
            $this->name         = $this->brand->name;
            $this->slug         = $this->brand->slug;
            $this->photoPreview = $this->brand->photo->url;
            $this->in_home_page = $this->brand->in_home_page;
            $this->editId       = $this->brand->id;
        }
    }

    public function render()
    {
        $this->in_home_page = 0 == $this->in_home_page ? '' : 1;
        return view('livewire.admin.' . $this->that . '.data-entry')
            ->layout('layouts.admin');
    }
}
