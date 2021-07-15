<?php

namespace App\Http\Livewire\Admin\Tax;

use App\Models\Tax;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DataEntry extends Component
{
    public $that   = 'tax';
    public $thatUp = 'Tax';
    public $editId = '';

    public $value;
    public $description;

    public $tax;

    public function submit()
    {
        $validationArr = '' != $this->editId ? [
            'value'       => ['required', 'integer', Rule::unique('taxes')->ignore($this->editId)],
            'description' => ['required', Rule::unique('taxes')->ignore($this->editId)],
        ]
        : [
            'value'       => 'required:unique:taxes|integer',
            'description' => 'required|unique:taxes',
        ];

        $this->validate($validationArr);

        $form = [
            'value'       => $this->value,
            'description' => $this->description,
        ];
        $status = "added";

        if ('' != $this->editId && $this->tax && can('edit tax')) {
            $this->tax->update($form);
            $status = "updated";
        } else if (can('add tax')) {
            Tax::create($form);
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->tax         = Tax::where('id', $id)->firstOrFail();
            $this->value       = $this->tax->value;
            $this->description = $this->tax->description;
            $this->editId      = $this->tax->id;
        }
    }

    public function render()
    {
        return view('livewire.admin.tax.data-entry')
            ->layout('layouts.admin');
    }
}
