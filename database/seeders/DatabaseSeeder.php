<?php

namespace Database\Seeders;

use App\Models\AboutsUs;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\MyShop;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(50)->create();
        // Category::factory(300)->create();
        AboutsUs::factory(1)->create();

        MyShop::factory(1)->create();

        $permissions = [
            [
                'name'     => 'view user',
                'group_by' => 'user',
            ],
            [
                'name'     => 'view dashboard',
                'group_by' => 'dashboard',
            ],
            [
                'name'     => 'view contacts',
                'group_by' => 'contacts',
            ],
            [
                'name'     => 'view order',
                'group_by' => 'order',
            ],
            [
                'name'     => 'manage order',
                'group_by' => 'order',
            ],
            [
                'name'     => 'edit user',
                'group_by' => 'user',
            ],
            [
                'name'     => 'manage about us',
                'group_by' => 'about us',
            ],
            [
                'name'     => 'manage my shop',
                'group_by' => 'my shop',
            ],
            [
                'name'     => 'view category',
                'group_by' => 'category',
            ],
            [
                'name'     => 'add category',
                'group_by' => 'category',
            ],
            [
                'name'     => 'edit category',
                'group_by' => 'category',
            ],
            [
                'name'     => 'view coupon',
                'group_by' => 'coupon',
            ],
            [
                'name'     => 'add coupon',
                'group_by' => 'coupon',
            ],
            [
                'name'     => 'edit coupon',
                'group_by' => 'coupon',
            ],
            [
                'name'     => 'view size',
                'group_by' => 'size',
            ],
            [
                'name'     => 'add size',
                'group_by' => 'size',
            ],
            [
                'name'     => 'edit size',
                'group_by' => 'size',
            ],
            [
                'name'     => 'view brand',
                'group_by' => 'brand',
            ],
            [
                'name'     => 'add brand',
                'group_by' => 'brand',
            ],
            [
                'name'     => 'edit brand',
                'group_by' => 'brand',
            ],
            [
                'name'     => 'view color',
                'group_by' => 'color',
            ],
            [
                'name'     => 'add color',
                'group_by' => 'color',
            ],
            [
                'name'     => 'edit color',
                'group_by' => 'color',
            ],
            [
                'name'     => 'view product',
                'group_by' => 'product',
            ],
            [
                'name'     => 'add product',
                'group_by' => 'product',
            ],
            [
                'name'     => 'edit product',
                'group_by' => 'product',
            ],
            [
                'name'     => 'view tax',
                'group_by' => 'tax',
            ],
            [
                'name'     => 'add tax',
                'group_by' => 'tax',
            ],
            [
                'name'     => 'edit tax',
                'group_by' => 'tax',
            ],
            [
                'name'     => 'view slider',
                'group_by' => 'slider',
            ],
            [
                'name'     => 'add slider',
                'group_by' => 'slider',
            ],
            [
                'name'     => 'edit slider',
                'group_by' => 'slider',
            ],
        ];

        foreach ($permissions as $permission) {Permission::create($permission);}

        User::create([
            'name'              => 'laravel',
            'email'             => "ecom@mail.com",
            'password'          => bcrypt('secret'),
            'remember_token'    => Str::random(10),
            'email_verified_at' => now(),
        ]);

        foreach (Permission::orderBy('group_by')->get("name")->toArray() as $key => $permission) {
            $allPermissions[$key] = $permission['name'];
        }

        User::first()->syncPermissions($allPermissions);

        Size::create(['size' => 'xs']);
        Size::create(['size' => 'sm']);
        Size::create(['size' => 'md']);
        Size::create(['size' => 'lg']);
        Size::create(['size' => 'xl']);

        Coupon::create(['title' => 'First Shop', 'code' => 'first123', 'value' => 100, 'cart_min_value' => 300, 'type' => 'F', 'expired_on' => now()->addYears(5)]);

        Category::create(['name' => 'Computer', 'slug' => 'computer', 'in_home_page' => '1']);
        Brand::create(['name' => 'Computer', 'slug' => 'computer', 'in_home_page' => '1']);

        Color::create(['value' => '#d4cece']);
        Color::create(['value' => '#f76262']);
        Color::create(['value' => '#6b6b6b']);
        Color::create(['value' => '#78b6f5']);

        Tax::create(['value' => 10, 'description' => '10% tax']);

        Slider::create(['sub_heading' => 'Shop from here', 'heading' => 'Shop', 'link' => url('shop'), 'link_text' => 'Shop Now', 'order_id' => 1]);
        Slider::create(['sub_heading' => 'This is our shop', 'heading' => 'Our Shop', 'link' => url('shop'), 'link_text' => 'Shop Now', 'order_id' => 2]);

        Product::create([
            'name'              => 'Desktop Computer',
            'slug'              => 'desktop-computer',
            'category_id'       => 1,
            'brand_id'          => 1,
            'short_description' => '<h1></h1><p>Short Description</p>',
            'description'       => '<h1></h1><p>Description</p>',
            'keywords'          => 'desktop, computer',
            'lead_time'         => 10,
            'tax_id'            => 1,
            'promo'             => 0,
            'featured'          => 1,
            'discounted'        => 0,
            'trending'          => 0,
            'best_seller'       => 0,
        ]);

        ProductDetail::create([
            'sku'        => 'sku',
            'mrp'        => 3567,
            'price'      => 3450,
            'qty'        => 100,
            'size_id'    => 1,
            'color_id'   => 1,
            'product_id' => 1,
            'order_id'   => 1,
            'status'     => 1,
        ]);
    }
}
