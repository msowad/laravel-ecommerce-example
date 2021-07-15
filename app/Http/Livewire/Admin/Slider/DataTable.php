<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Admin\WithAdminDataTable;
use App\Models\Slider;
use Livewire\Component;

class DataTable extends Component
{
    public $that      = 'slider';
    public $model     = 'Slider';
    public $namespace = Slider::class;

    use WithAdminDataTable;

    protected $queryString;

    public function __construct()
    {
        $this->hasPhoto = true;

        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();
    }

    public function dehydrate()
    {
        $this->emit('observeImage');
    }

    public function selectAll()
    {
        if ($this->isAllSelect == false) {
            $this->selected = $this->onlyTrashed == true
            ? $this->getModelProperty(false)->map(fn($id) => (string) $id)
            : $this->getModelProperty(false)->map(fn($id) => (string) $id);
            $this->isAllSelect = true;
            $this->selectPage  = true;
        } else {
            $this->clearSelected();
        }
    }

    public function clear($of)
    {
        switch ($of) {
            case 'all':
                $this->clearBasicAll();
                break;
        }
        $this->clearBasic($of);
    }

    public function getModelProperty($paginate = true)
    {
        $obj = $this->obj;
        $qry = $obj->where(function ($query) {
            $query->where('heading', 'like', '%' . $this->search . '%')
                ->orWhere('sub_heading', 'like', '%' . $this->search . '%')
                ->orWhere('order_id', 'like', '%' . $this->search . '%')
                ->orWhere('link', 'like', '%' . $this->search . '%')
                ->orWhere('link_text', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });

        $qry->with('photo');

        return $this->getCommonModalProperty($qry, $paginate);
    }

    public function render()
    {
        $this->getCacheData();
        $items = $this->getModelProperty();

        return view('livewire.admin.' . $this->that . '.data-table', compact('items', $items))
            ->layout('layouts.admin');
    }
}
