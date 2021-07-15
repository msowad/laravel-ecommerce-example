<?php

namespace App\Http\Livewire\Admin\Category;

use App\Http\Controllers\MediaController;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataEntry extends Component
{
    use WithFileUploads;

    public $that   = 'category';
    public $thatUp = 'Category';

    public $name;
    public $slug;

    public $editId = '';
    public $category;
    public $in_home_page;
    public $parent_category = null;
    public $parent_category_arr;
    public $photo;

    public $photoPreview = '';

    protected $listeners = ['submit'];

    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->validate(['photo' => 'image|mimes:jpeg,jpg,png']);
        }
    }

    public function submit()
    {
        $this->slug    = '' != $this->slug ? Str::slug($this->slug) : Str::slug($this->name);
        $validationArr = '' != $this->editId ? [
            'name' => ['required', Rule::unique('categories')->ignore($this->editId)],
            'slug' => ['required', Rule::unique('categories')->ignore($this->editId)],
        ]
        : [
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
        ];

        if ($this->photo && '' != $this->editId) {
            $validationArr = array_merge($validationArr, ['photo' => 'image|mimes:jpeg,jpg,png']);
        }

        $this->validate($validationArr);

        $media = MediaController::set(Category::class, $this->photo, 'category', $this->slug);

        $form = [
            'name'            => $this->name,
            'slug'            => $this->slug,
            'in_home_page'    => $this->in_home_page,
            'parent_category' => $this->parent_category,
        ];

        $status = "added";

        if ('' != $this->editId && $this->category && can('edit category')) {

            $media?->replace($this->editId);

            $this->category->update($form);
            $status = "updated";
        } else if (can('add category')) {
            $category = Category::create($form);
            $media?->upload($category->id);
        }

        session()->flash('success_msg', 'Category ' . $status);
        return redirect()->route('dashboard.category');
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->category        = Category::with('photo')->where('id', $id)->firstOrFail();
            $this->name            = $this->category->name;
            $this->slug            = $this->category->slug;
            $this->photoPreview    = $this->category->photo->url;
            $this->in_home_page    = $this->category->in_home_page;
            $this->parent_category = $this->category->parent_category;
            $this->editId          = $this->category->id;
        }

        $this->parent_category_arr = '' != $this->editId ? Category::where('status', 1)->where('id', '!=', $this->editId)->get(['name', 'id'])->toArray()
        : Category::where('status', 1)->get(['name', 'id'])->toArray();
    }

    public function render()
    {
        $this->in_home_page = 0 == $this->in_home_page ? "" : 1;
        return view('livewire.admin.category.data-entry')
            ->layout('layouts.admin');
    }
}
