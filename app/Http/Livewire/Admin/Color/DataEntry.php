<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Color;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DataEntry extends Component
{
    public $that   = 'color';
    public $thatUp = 'Color';
    public $editId = '';

    public $value = '';

    public $color;

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'value' => ['required', Rule::unique('colors')->ignore($this->editId)],
        ]
        : [
            'value' => 'required|unique:colors',
        ];

        $this->validate($validationArr);

        $form = [
            'value' => $this->value,
        ];

        $status = "added";

        if ('' != $this->editId && $this->color && can('edit color')) {
            $this->color->update($form);
            $status = "updated";
        } else if (can('add color')) {
            Color::create($form);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->color  = Color::where('id', $id)->firstOrFail();
            $this->value  = $this->color->value;
            $this->editId = $this->color->id;
        }
    }

    public function render()
    {
        return view('livewire.admin.' . $this->that . '.data-entry')
            ->layout('layouts.admin');
    }
}
