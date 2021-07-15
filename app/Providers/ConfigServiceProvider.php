<?php

namespace App\Providers;

use App\Models\MyShop;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $shop = null;

        if (cache()->has('app.info')) {
            $shop = cache("app.info");
        } else {
            try {
                DB::connection()->getPdo();
                if (Schema::hasTable(MyShop::getTableName())) {
                    $shop = MyShop::with(['logoPrimary', 'logoSecondary', 'favicon'])->first();
                    cache()->put("app.info", $shop, now()->addHours(72));
                }
            } catch (Exception $e) {
                info($e);
            }
        }

        if ($shop) {
            $this->setConfig($shop);

            if (date_default_timezone_get() != $shop->timezone) {
                if ($shop->timezone != '') {
                    date_default_timezone_set($shop->timezone);
                }
            }
        }
    }

    private function setConfig($shop)
    {
        config(['app.name' => $shop->name]);
        config(['app.logo' => $shop->logoPrimary->url]);
        config(['app.secondary_logo' => $shop->logoSecondary->url]);
        config(['app.favicon' => $shop->favicon->url]);
        config(['app.timezone' => $shop->timezone]);
    }
}
