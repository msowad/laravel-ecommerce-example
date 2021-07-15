<?php

namespace App\Http\Livewire\Admin\Size;

use App\Models\Size;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DataEntry extends Component
{
    public $size;

    public $that   = 'size';
    public $thatUp = 'Size';

    public $editId = '';
    public $sizeDb;

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'size' => ['required', Rule::unique('sizes')->ignore($this->editId)],
        ]
        : [
            'size' => 'required|unique:sizes',
        ];

        $this->validate($validationArr);

        $form   = ['size' => $this->size];
        $status = "added";

        if ('' != $this->editId && $this->sizeDb && can('edit size')) {
            $this->sizeDb->update($form);
            $status = "updated";
        } else if(can('add size')) {
            Size::create($form);
        }

        session()->flash('success_msg', 'Size ' . $status);
        return redirect()->route('dashboard.size');
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->sizeDb = Size::where('id', $id)->firstOrFail();
            $this->size   = $this->sizeDb->size;
            $this->editId = $this->sizeDb->id;
        }
    }

    public function render()
    {
        return view('livewire.admin.size.data-entry')
            ->layout('layouts.admin');
    }
}
