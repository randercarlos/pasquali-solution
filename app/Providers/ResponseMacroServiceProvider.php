<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
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
        Response::macro('success', function ($data, $statusCode = 200) {
            return response()->json($array = [
                'success' => true,
                'data' => $data,
            ], $statusCode);
        });

        Response::macro('fail', function ($msg, $statusCode) {
            return response()->json([
                'success' => false,
                'msg' => $msg,
            ], $statusCode);
        });
    }
}
