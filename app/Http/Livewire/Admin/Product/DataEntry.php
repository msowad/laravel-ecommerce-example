<?php

namespace App\Http\Livewire\Admin\Product;

use App\Http\Controllers\MediaController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\Tax;
use App\Rules\NotNull;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataEntry extends Component
{
    use WithFileUploads;

    public $that   = 'product';
    public $thatUp = 'Product';
    public $editId = '';

    public $category;
    public $brand;
    public $name;
    public $slug;
    public $model;
    public $short_description;
    public $description;
    public $keywords;
    public $technical_specification;
    public $usage;
    public $warrenty;

    public $lead_time;
    public $tax;
    public $promo;
    public $featured;
    public $discounted;
    public $trending;
    public $best_seller;

    public $attributes = [];

    public $product;

    public $categories;
    public $taxes;
    public $brands;
    public $sizesDt;
    public $colorsDt;

    public $photos   = [];
    public $newPhoto = [];

    public $previousPhoto = [];
    public $hasAttr       = false;

    protected $listeners = ['removeAttr'];

    protected function rules()
    {
        return '' != $this->editId ? [
            'name'                => ['required', Rule::unique('products')->ignore($this->editId)],
            'slug'                => ['required', Rule::unique('products')->ignore($this->editId)],
            'category'            => ['required', 'integer'],
            'brand'               => ['required', 'integer'],
            'model'               => 'nullable',
            'short_description'   => 'required',
            'description'         => 'required',
            'keywords'            => 'required',
            'tax'                 => 'required|integer',
            'promo'               => ['required', Rule::in([0, 1])],
            'featured'            => ['required', Rule::in([0, 1])],
            'discounted'          => ['required', Rule::in([0, 1])],
            'trending'            => ['required', Rule::in([0, 1])],
            'best_seller'         => ['required', Rule::in([0, 1])],

            'attributes.*.color'  => ['required', new NotNull],
            'attributes.*.size'   => ['required', new NotNull],
            'attributes.*.sku'    => ['required', new NotNull],
            'attributes.*.mrp'    => ['required', new NotNull, 'integer'],
            'attributes.*.price'  => ['required', new NotNull, 'integer'],
            'attributes.*.qty'    => ['required', new NotNull, 'integer'],
            'attributes.*.status' => [Rule::in([1, 0])],
            'attributes.*.photo'  => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (method_exists($value, 'getMimeType')) {
                        if (!in_array($value->getMimeType(), ["image/jpeg", "image/png", "image/jpg"])) {
                            return $fail('The ' . $attribute . ' must be a file of type: jpeg, jpg, png.');
                        }
                    } else if (gettype($value) != 'string') {
                        return $fail('The ' . $attribute . ' is invalid.');
                    }
                },
            ],
        ]
        : [
            'name'                => 'required|unique:products',
            'slug'                => 'required|unique:products',
            'category'            => ['required', 'integer'],
            'brand'               => ['required', 'integer'],
            'model'               => 'nullable',
            'short_description'   => 'required',
            'description'         => 'required',
            'keywords'            => 'required',
            'tax'                 => 'required|integer',
            'promo'               => ['required', Rule::in([0, 1])],
            'featured'            => ['required', Rule::in([0, 1])],
            'discounted'          => ['required', Rule::in([0, 1])],
            'trending'            => ['required', Rule::in([0, 1])],
            'best_seller'         => ['required', Rule::in([0, 1])],

            'attributes.*.color'  => ['required', new NotNull],
            'attributes.*.size'   => ['required', new NotNull],
            'attributes.*.sku'    => ['required', new NotNull],
            'attributes.*.mrp'    => ['required', new NotNull, 'integer'],
            'attributes.*.price'  => ['required', new NotNull, 'integer'],
            'attributes.*.qty'    => ['required', new NotNull, 'integer'],
            'attributes.*.status' => [Rule::in([1, 0])],
            'attributes.*.photo'  => 'image|mimes:jpeg,jpg,png',
        ];
    }

    public function validatePhoto()
    {
        $this->validate(['attributes.*.photo' => [
            'nullable',
            function ($attribute, $value, $fail) {
                if (method_exists($value, 'getMimeType')) {
                    if (!in_array($value->getMimeType(), ["image/jpeg", "image/png", "image/jpg"])) {
                        return $fail('The ' . $attribute . ' must be a file of type: jpeg, jpg, png.');
                    }
                } else if (gettype($value) != 'string') {
                    return $fail('The ' . $attribute . ' is invalid.');
                }
            },
        ]]);
    }

    public function dehydrate()
    {
        $this->emit('setEditor');
    }

    public function hydrate()
    {
        $this->hasAttr = count($this->attributes) > 0 ? true : false;
    }

    public function updatedNewPhoto()
    {
        $index = array_key_last($this->newPhoto);
        if ($this->attributes[$index]) {
            $this->attributes[$index]['photo'] = $this->newPhoto[$index];
            $this->attributes[$index]['src']   = $this->newPhoto[$index]->temporaryUrl();
        }

        $this->newPhoto = [];
        $this->validatePhoto();
    }

    public function updatedPhotos()
    {
        $i   = count($this->attributes);
        $end = $i + count($this->photos);

        for ($i = $i, $j = 0; $i < $end, $j < count($this->photos); $i++, $j++) {
            $this->attributes[$i] = [
                'photo'     => $this->photos[$j],
                'src'       => $this->photos[$j]->temporaryUrl(),
                'color'     => '',
                'size'      => '',
                'sku'       => '',
                'mrp'       => '',
                'price'     => '',
                'qty'       => '',
                'order_id'  => '',
                'status'    => 1,
                'new_photo' => '',
                'id'        => '',
            ];
        }
        $this->photos = [];
        $this->validatePhoto();
    }

    public function removeAttr($index)
    {
        if ('' != $this->attributes[$index]['id']) {
            $data = ProductDetail::find($this->attributes[$index]['id']);
            if ($data) {
                Storage::delete('public/product_image/' . $data->photos);
                $data->forceDelete();
            }
        }

        array_splice($this->attributes, $index, 1);
        $this->validatePhoto();
    }

    public function resortAttr($keys)
    {
        $resort = array_column($keys, 'value');
        array_multisort($resort, SORT_ASC, $this->attributes);
        $this->validatePhoto();
    }

    public function submit()
    {

        $this->slug = '' != $this->slug ? Str::slug($this->slug) : Str::slug($this->name);

        $this->promo       = 'true' == $this->promo ? 1 : 0;
        $this->featured    = 'true' == $this->featured ? 1 : 0;
        $this->discounted  = 'true' == $this->discounted ? 1 : 0;
        $this->trending    = 'true' == $this->trending ? 1 : 0;
        $this->best_seller = 'true' == $this->best_seller ? 1 : 0;

        $this->validate();

        $form = [
            'name'                    => $this->name,
            'slug'                    => $this->slug,
            'category_id'             => $this->category,
            'brand_id'                => $this->brand,
            'model'                   => $this->model,
            'short_description'       => $this->short_description,
            'description'             => $this->description,
            'keywords'                => $this->keywords,
            'technical_specification' => $this->technical_specification,
            'usage'                   => $this->usage,
            'warrenty'                => $this->warrenty,
            'lead_time'               => $this->lead_time,
            'tax_id'                  => $this->tax,
            'promo'                   => $this->promo,
            'featured'                => $this->featured,
            'discounted'              => $this->discounted,
            'trending'                => $this->trending,
            'best_seller'             => $this->best_seller,
        ];
        $status = "added";

        if ('' != $this->editId && $this->product && can('edit product')) {
            $this->product->update($form);

            foreach ($this->attributes as $key => $attribute) {
                if ('' != $attribute['id']) {

                    $productDetailUpdate = ProductDetail::where('product_id', $this->editId)->where('id', $attribute['id'])->first();

                    if ($attribute['photo'] && method_exists($attribute['photo'], 'storeAs')) {
                        $media = MediaController::set(ProductDetail::class, $attribute['photo'], 'products', $this->product->slug . '__' . $key);
                        $media?->replace($attribute['id']);
                    }

                    if ($productDetailUpdate) {
                        $productDetailUpdate->update([
                            'sku'      => $attribute['sku'],
                            'mrp'      => $attribute['mrp'],
                            'price'    => $attribute['price'],
                            'qty'      => $attribute['qty'],
                            'size_id'  => $attribute['size'],
                            'color_id' => $attribute['color'],
                            'status'   => $attribute['status'],
                            'order_id' => $key + 1,
                        ]);
                    }
                } else {
                    $id    = $this->storeDetail($this->editId, $attribute, $key);
                    $media = MediaController::set(ProductDetail::class, $attribute['photo'], 'products', $this->product->slug . '__' . $key);
                    $media?->upload($id);
                }
            }

            $status = "updated";
        } else {
            if (can('add product')) {
                $product = Product::create($form);
            }

            if ($this->hasAttr) {
                foreach ($this->attributes as $key => $attribute) {
                    $media = MediaController::set(ProductDetail::class, $attribute['photo'], 'products', $product->slug . '__' . $key);

                    $id = $this->storeDetail($product->id, $attribute, $key);
                    $media?->upload($id);
                }
            }
        }

        session()->flash('success_msg', $this->thatUp . ' ' . $status);
        return redirect()->route('dashboard.' . $this->that);
    }

    public function storeDetail($pid, $attribute, $key)
    {
        if (can('add product')) {
            $product = ProductDetail::create([
                'sku'        => $attribute['sku'],
                'mrp'        => $attribute['mrp'],
                'price'      => $attribute['price'],
                'qty'        => $attribute['qty'],
                'size_id'    => $attribute['size'],
                'color_id'   => $attribute['color'],
                'product_id' => $pid,
                'order_id'   => $key + 1,
                'status'     => $attribute['status'],
            ]);

            return $product->id;
        }
    }

    public function mount($id = '')
    {
        if ('' != $id) {
            $this->product                 = Product::where('id', $id)->with('productDetails')->firstOrFail();
            $this->name                    = $this->product->name;
            $this->slug                    = $this->product->slug;
            $this->category                = $this->product->category_id;
            $this->brand                   = $this->product->brand_id;
            $this->model                   = $this->product->model;
            $this->short_description       = $this->product->short_description;
            $this->description             = $this->product->description;
            $this->keywords                = $this->product->keywords;
            $this->description             = $this->product->description;
            $this->technical_specification = $this->product->technical_specification;
            $this->usage                   = $this->product->usage;
            $this->warrenty                = $this->product->warrenty;
            $this->editId                  = $this->product->id;

            $this->lead_time   = $this->product->lead_time;
            $this->tax         = $this->product->tax_id;
            $this->promo       = $this->product->promo;
            $this->featured    = $this->product->featured;
            $this->discounted  = $this->product->discounted;
            $this->trending    = $this->product->trending;
            $this->best_seller = $this->product->best_seller;

            if ($this->product->productDetails->count() > 0) {

                foreach ($this->product->productDetails as $key => $productDetailDt) {
                    $this->attributes[$key] = [
                        'photo'     => $productDetailDt->photos,
                        'src'       => $productDetailDt->photo->url,
                        'color'     => $productDetailDt->color_id,
                        'size'      => $productDetailDt->size_id,
                        'sku'       => $productDetailDt->sku,
                        'mrp'       => $productDetailDt->mrp,
                        'price'     => $productDetailDt->price,
                        'qty'       => $productDetailDt->qty,
                        'order_id'  => $productDetailDt->order_id,
                        'status'    => $productDetailDt->status,
                        'new_photo' => '',
                        'id'        => $productDetailDt->id,
                    ];
                }
            }
        }
    }

    public function render()
    {
        $this->promo       = 1 == $this->promo ? true : false;
        $this->featured    = 1 == $this->featured ? true : false;
        $this->discounted  = 1 == $this->discounted ? true : false;
        $this->trending    = 1 == $this->trending ? true : false;
        $this->best_seller = 1 == $this->best_seller ? true : false;

        $this->hasAttr = count($this->attributes) > 0 ? true : false;

        $this->categories = Category::where('status', 1)->get(['name', 'id'])->toArray();
        $this->taxes      = Tax::where('status', 1)->get(['id', 'description'])->toArray();
        $this->brands     = Brand::where('status', 1)->get(['name', 'id'])->toArray();

        $this->sizesDt  = $this->hasAttr ? Size::where('status', 1)->get()->toArray() : [];
        $this->colorsDt = $this->hasAttr ? Color::where('status', 1)->get()->toArray() : [];

        return view('livewire.admin.product.data-entry')
            ->layout('layouts.admin');
    }
}
