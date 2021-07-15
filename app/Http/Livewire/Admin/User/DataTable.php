<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public $that  = 'user';
    public $model = 'User';

    public $selected    = [];
    public $selectPage  = false;
    public $isAllSelect = false;

    public $sortedField = 'id';
    public $sortedOrder = 'desc';
    public $sorted      = '';

    public $perPage = 10;

    public $search = '';

    public $addedOnFrom = '';
    public $addedOnTo   = '';

    public $status   = '';
    public $verified = '';

    protected $queryString = [
        'search'      => ['except' => ''],
        'addedOnFrom' => ['except' => ''],
        'addedOnTo'   => ['except' => ''],
        'status'      => ['except' => ''],
        'verified'    => ['except' => ''],
    ];

    public function updatedAddedOnFrom()
    {
        $this->addedOnFrom = '' != $this->addedOnTo ? ($this->addedOnFrom > $this->addedOnTo ? $this->addedOnTo : $this->addedOnFrom)
        : ($this->addedOnFrom > date('Y-m-d') ? date('Y-m-d') : $this->addedOnFrom);
    }

    public function updatedAddedOnTo()
    {
        $this->addedOnTo   = $this->addedOnTo > date('Y-m-d') ? date('Y-m-d') : $this->addedOnTo;
        $this->addedOnFrom = '' != $this->addedOnTo ? ($this->addedOnFrom > $this->addedOnTo ? $this->addedOnTo : $this->addedOnFrom)
        : $this->addedOnFrom;
    }

    public function updatedPerPage()
    {
        $this->perPage = 0 == $this->perPage ? 10 : $this->perPage;
        $this->resetPage();
        Cache::put($this->that . '.perPage', $this->perPage);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function clearSelected()
    {
        $this->selected    = [];
        $this->selectPage  = false;
        $this->isAllSelect = false;
    }

    public function updatedSelected()
    {
        $this->isAllSelect = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->getModelProperty()->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->isAllSelect = false;
            $this->selected    = [];
        }
    }

    public function selectAll()
    {
        if (false == $this->isAllSelect) {
            $this->selected    = $this->getModelProperty(false)->pluck('id')->map(fn($id) => (string) $id);
            $this->isAllSelect = true;
            $this->selectPage  = true;
        } else {
            $this->clearSelected();
        }
    }

    public function sort($filed, $order)
    {
        $this->sortedOrder = $order;
        $this->sortedField = $filed;

        Cache::put($this->that . '.sortedOrder', $order);
        Cache::put($this->that . '.sortedField', $filed);
    }

    public function getCacheData()
    {
        $this->perPage     = Cache::has($this->that . '.perPage') ? Cache::get($this->that . '.perPage') : $this->perPage;
        $this->sortedField = Cache::has($this->that . '.sortedField') ? Cache::get($this->that . '.sortedField') : $this->sortedField;
        $this->sortedOrder = Cache::has($this->that . '.sortedOrder') ? Cache::get($this->that . '.sortedOrder') : $this->sortedOrder;
        $this->sorted      = $this->sortedField . '' . $this->sortedOrder;
    }

    public function activeChecked()
    {
        if (can('edit user')) {
            User::whereIn('id', $this->selected)->update(['status' => 1]);
        }
    }

    public function deactiveChecked()
    {
        if (can('edit user')) {
            User::whereIn('id', $this->selected)->update(['status' => 0]);
        }
    }

    public function status($id, $status)
    {
        if (can('edit user')) {
            $data         = User::findOrFail($id);
            $status       = (1 == $status) ? 0 : 1;
            $data->status = $status;
            $data->save();
        }
    }

    public function clear($of)
    {
        switch ($of) {
            case 'all':
                $this->status = '';
                $this->search = '';
                $this->reset('verified');
                $this->addedOnFrom = '';
                $this->addedOnTo   = '';
                break;
            case 'search':
                $this->search = '';
                break;
            case 'addedOnFrom':
                $this->addedOnFrom = '';
                break;
            case 'addedOnTo':
                $this->addedOnTo = '';
                break;
            case 'status':
                $this->status = '';
                break;
            case 'verified':
                $this->reset('verified');
                break;
        }
    }

    public function getModelProperty($paginate = true)
    {
        $qry = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('mobile', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orWhere('city', 'like', '%' . $this->search . '%')
                ->orWhere('state', 'like', '%' . $this->search . '%')
                ->orWhere('company', 'like', '%' . $this->search . '%')
                ->orWhere('zip', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
        });
        $this->status == 'activated' ? $qry->where('status', 1) : '';
        $this->status == 'deactivated' ? $qry->where('status', 0) : '';

        if ($this->verified == 1) {
            $qry->where('email_verified_at', '!=', null);
        } elseif ($this->verified == 0) {
            $qry->where('email_verified_at', null);
        }

        $this->addedOnFrom != '' ? $qry->where('created_at', '>=', $this->addedOnFrom . ' 00:00:00') : '';
        $this->addedOnTo != '' ? $qry->where('created_at', '<=', $this->addedOnTo . ' 23:59:59') : '';

        $qry->orderBy($this->sortedField, $this->sortedOrder);
        return $paginate ? $qry->paginate($this->perPage) : $qry->get();
    }

    public function render()
    {
        $this->getCacheData();
        $items = $this->getModelProperty();

        return view('livewire.admin.' . $this->that . '.data-table', compact('items', $items))
            ->layout('layouts.admin');
    }
}
