<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Http\Controllers\MediaController;
use App\Models\Slider;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataEntry extends Component
{
    use WithFileUploads;

    public $that   = 'slider';
    public $thatUp = 'Slider';
    public $editId = '';

    public $heading;
    public $sub_heading;
    public $link;
    public $link_text;
    public $order_id;
    public $slider;

    public $photo;

    public $photoPreview = '';

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->validate(['photo' => 'image|mimes:jpeg,jpg,png']);
        }
    }

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'heading'     => ['required', Rule::unique('sliders')->ignore($this->editId)],
            'sub_heading' => ['required', Rule::unique('sliders')->ignore($this->editId)],
            'link'        => 'required|url',
            'link_text'   => 'required',
            'order_id'    => 'required|integer',
        ]
        : [
            'heading'     => 'required|unique:sliders',
            'sub_heading' => 'required|unique:sliders',
            'link'        => 'required|url',
            'link_text'   => 'required',
            'order_id'    => 'required|integer',
            'photo'       => 'required|image|mimes:jpeg,jpg,png',
        ];

        if ($this->photo && '' != $this->editId) {
            $validationArr = array_merge($validationArr, ['photo' => 'image|mimes:jpeg,jpg,png']);
        }

        $this->validate($validationArr);

        $media = MediaController::set(Slider::class, $this->photo, 'slider', $this->order_id);

        $form = [
            'heading'     => $this->heading,
            'sub_heading' => $this->sub_heading,
            'link'        => $this->link,
            'link_text'   => $this->link_text,
            'order_id'    => $this->order_id,
        ];

        $status = "added";

        if ('' != $this->editId && $this->slider && can('edit slider')) {
            $media?->replace($this->editId);

            $this->slider->update($form);
            $status = "updated";
        } else if ('add slider') {
            $slider = Slider::create($form);
            $media?->upload($slider->id);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->slider       = Slider::with('photo')->where('id', $id)->firstOrFail();
            $this->heading      = $this->slider->heading;
            $this->sub_heading  = $this->slider->sub_heading;
            $this->link         = $this->slider->link;
            $this->link_text    = $this->slider->link_text;
            $this->order_id     = $this->slider->order_id;
            $this->photoPreview = $this->slider->photo->url;
            $this->editId       = $this->slider->id;
        }
    }

    public function render()
    {
        return view('livewire.admin.' . $this->that . '.data-entry')
            ->layout('layouts.admin');
    }
}
