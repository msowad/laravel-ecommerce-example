<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Admin\WithAdminDataTable;

class DataTable extends Component
{
    public $that = 'coupon';
    public $model = 'Coupon';

    public $expiredOnFrom = '';
    public $expiredOnTo = '';

    use WithAdminDataTable;

    protected $queryString;

    public function __construct()
    {
        $this->queryStringArr = array_merge($this->queryStringArr, [
            'expiredOnFrom' => ['except' => ''],
            'expiredOnTo' => ['except' => ''],
        ]);

        $this->queryString = $this->queryStringArr;

        $modelName = 'App\\Models\\' . $this->model;
        $this->obj = new $modelName();
    }

    public function selectAll()
    {
        if ($this->isAllSelect == false) {
            $this->selected = $this->onlyTrashed == true
                ? $this->getModelProperty(false)->map(fn ($id) => (string) $id)
                : $this->getModelProperty(false)->map(fn ($id) => (string) $id);
            $this->isAllSelect = true;
            $this->selectPage = true;
        } else {
            $this->clearSelected();
        }
    }

    public function clear($of)
    {
        switch ($of) {
            case 'all':
                $this->clearBasicAll();
                $this->expiredOnFrom = '';
                $this->expiredOnTo = '';
                break;
            case 'expiredOnFrom':
                $this->expiredOnFrom = '';
                break;
            case 'expiredOnTo':
                $this->expiredOnTo = '';
                break;
        }
        $this->clearBasic($of);
    }

    public function getModelProperty($paginate = true)
    {
        $obj = $this->obj;
        $qry = $obj->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->orWhere('value', 'like', '%' . $this->search . '%')
                ->orWhere('cart_min_value', 'like', '%' . $this->search . '%')
                ->orWhere('type', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });

        $this->expiredOnFrom != ''
            ? $qry->where('expired_on', '>=', $this->expiredOnFrom) : '';
        $this->expiredOnTo != ''
            ? $qry->where('expired_on', '<=', $this->expiredOnTo) : '';

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
