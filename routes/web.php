<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\PDFController;
use App\Http\Livewire\Admin\AboutUs;
use App\Http\Livewire\Admin\Admin as AdminAdmin;
use App\Http\Livewire\Admin\Brand\DataEntry as BrandDataEntry;
use App\Http\Livewire\Admin\Brand\DataTable as BrandDataTable;
use App\Http\Livewire\Admin\Category\DataEntry as CategoryDataEntry;
use App\Http\Livewire\Admin\Category\DataTable as CategoryDataTable;
use App\Http\Livewire\Admin\Color\DataEntry as ColorDataEntry;
use App\Http\Livewire\Admin\Color\DataTable as ColorDataTable;
use App\Http\Livewire\Admin\Contacts\DataTable as ContactsDataTable;
use App\Http\Livewire\Admin\Contacts\Detail;
use App\Http\Livewire\Admin\Coupon\DataEntry as CouponDataEntry;
use App\Http\Livewire\Admin\Coupon\DataTable as CouponDataTable;
use App\Http\Livewire\Admin\MyShop;
use App\Http\Livewire\Admin\Order\DataTable as OrderDataTable;
use App\Http\Livewire\Admin\Order\Detail as OrderDetail;
use App\Http\Livewire\Admin\Product\DataEntry;
use App\Http\Livewire\Admin\Product\DataTable;
use App\Http\Livewire\Admin\Size\DataEntry as SizeDataEntry;
use App\Http\Livewire\Admin\Size\DataTable as SizeDataTable;
use App\Http\Livewire\Admin\Slider\DataEntry as SliderDataEntry;
use App\Http\Livewire\Admin\Slider\DataTable as SliderDataTable;
use App\Http\Livewire\Admin\Tax\DataEntry as TaxDataEntry;
use App\Http\Livewire\Admin\Tax\DataTable as TaxDataTable;
use App\Http\Livewire\Admin\User\DataEntry as UserDataEntry;
use App\Http\Livewire\Admin\User\DataTable as UserDataTable;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Category;
use App\Http\Livewire\Child\SearchForm;
use App\Http\Livewire\Home;
use App\Http\Livewire\ProductDetail;
use App\Http\Livewire\Wishlist;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/category/{slug}', Category::class)->name('category');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');

Route::get('/searchTags', [SearchForm::class, 'searchTags'])->name('searchTags');
Route::get('/search/{term}', [FrontController::class, 'search'])->name('search');

Route::get('/verify/{code}', [FrontController::class, 'verify'])->name('verify');

Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact-us', [FrontController::class, 'contactUs'])->name('contactUs');

Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');

Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', Wishlist::class)->name('wishlist')->middleware('verified');
    Route::get('/profile', [FrontController::class, 'profile'])->name('profile')->middleware('verified');
    Route::get('/order', [FrontController::class, 'order'])->name('order');
    Route::get('/order-detail/{id}', [FrontController::class, 'orderDetail'])->name('order.detail');
});

Route::get("order/pdf/{id}", [PDFController::class, "download"])->name("pdf");

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', AdminAdmin::class)->name('dashboard.home');

    // Category Routes
    Route::get('/category', CategoryDataTable::class)->name('dashboard.category')->middleware('can:view category');
    Route::get('/category/add', CategoryDataEntry::class)->name('dashboard.category.add')->middleware('can:add category');
    Route::get('/category/edit/{id}', CategoryDataEntry::class)->name('dashboard.category.edit')->middleware('can:edit category');

    // Coupon Routes
    Route::get('/coupon', CouponDataTable::class)->name('dashboard.coupon')->middleware('can:view coupon');
    Route::get('/coupon/add', CouponDataEntry::class)->name('dashboard.coupon.add')->middleware('can:add coupon');
    Route::get('/coupon/edit/{id}', CouponDataEntry::class)->name('dashboard.coupon.edit')->middleware('can:edit coupon');

    // Sizes Routes
    Route::get('/size', SizeDataTable::class)->name('dashboard.size')->middleware('can:view size');
    Route::get('/size/add', SizeDataEntry::class)->name('dashboard.size.add')->middleware('can:add size');
    Route::get('/size/edit/{id}', SizeDataEntry::class)->name('dashboard.size.edit')->middleware('can:edit size');

    // Brand Routes
    Route::get('/brand', BrandDataTable::class)->name('dashboard.brand')->middleware('can:view brand');
    Route::get('/brand/add', BrandDataEntry::class)->name('dashboard.brand.add')->middleware('can:add brand');
    Route::get('/brand/edit/{id}', BrandDataEntry::class)->name('dashboard.brand.edit')->middleware('can:edit brand');

    // Color Routes
    Route::get('/color', ColorDataTable::class)->name('dashboard.color')->middleware('can:view color');
    Route::get('/color/add', ColorDataEntry::class)->name('dashboard.color.add')->middleware('can:add color');
    Route::get('/color/edit/{id}', ColorDataEntry::class)->name('dashboard.color.edit')->middleware('can:edit color');

    // Product Routes
    Route::get('/product', DataTable::class)->name('dashboard.product')->middleware('can:view product');
    Route::get('/product/add', DataEntry::class)->name('dashboard.product.add')->middleware('can:add product');
    Route::get('/product/edit/{id}', DataEntry::class)->name('dashboard.product.edit')->middleware('can:edit product');

    // Tax Routes
    Route::get('/tax', TaxDataTable::class)->name('dashboard.tax')->middleware('can:view tax');
    Route::get('/tax/add', TaxDataEntry::class)->name('dashboard.tax.add')->middleware('can:add tax');
    Route::get('/tax/edit/{id}', TaxDataEntry::class)->name('dashboard.tax.edit')->middleware('can:edit tax');

    // User Routes
    Route::get('/user', UserDataTable::class)->name('dashboard.user')->middleware('can:view user');
    Route::get('/user/edit/{id}', UserDataEntry::class)->name('dashboard.user.edit')->middleware('can:edit user');

    // Slider Routes
    Route::get('/slider', SliderDataTable::class)->name('dashboard.slider')->middleware('can:view slider');
    Route::get('/slider/add', SliderDataEntry::class)->name('dashboard.slider.add')->middleware('can:add slider');
    Route::get('/slider/edit/{id}', SliderDataEntry::class)->name('dashboard.slider.edit')->middleware('can:edit slider');

    Route::get('/about-us', AboutUs::class)->name('dashboard.aboutUs')->middleware('can:manage about us');
    Route::get('/my-shop', MyShop::class)->name('dashboard.myShop')->middleware('can:manage my shop');

    // Contact Routes
    Route::get('/contacts', ContactsDataTable::class)->name('dashboard.contacts')->middleware('can:view contacts');
    Route::get('/contacts/{id}', Detail::class)->name('dashboard.contacts.detail')->middleware('can:view contacts');

    // Order Routes
    Route::get('/order', OrderDataTable::class)->name('dashboard.order')->middleware('can:view order');
    Route::get('/order/{id}', OrderDetail::class)->name('dashboard.order.detail')->middleware('can:view order');
});
