<?php

namespace App\Http\Livewire\Admin\Category;

use App\Admin\WithAdminDataTable;
use App\Models\Category;
use Livewire\Component;

class DataTable extends Component
{
    public $that      = 'category';
    public $model     = 'Category';
    public $namespace = Category::class;

    use WithAdminDataTable;

    protected $queryString;

    public function dehydrate()
    {
        $this->emit('observeImage');
    }

    public function __construct()
    {
        $this->hasPhoto = true;

        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();
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
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });

        $qry->with(['parentCategory','photo']);

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
