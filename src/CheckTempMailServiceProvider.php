<?php

/*
 * This file is part of the Laravel Password package.
 *
 * (c) Diego Luiz
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DiegoMagikal\CheckTempMail;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Validator;

class CheckTempMailServiceProvider extends ServiceProvider
{
    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
     * Default error message.
     *
     * @var string
     */
    protected $message = 'This email is not allowed. Please insert your real email!';

    /**
     * Publishes all the config file this package needs to function.
     */
    public function boot()
    {
        Validator::extend('tempmail', function ($attribute, $value, $parameters, $validator) {
            
            list($name, $domain) = explode("@", $value);
            $temp   = explode(".", $domain);
            $tld    = end($temp);
            $path   = realpath(__DIR__ . '/../resources/config/tempmaildomains.txt');
            $cachek = md5_file($path);
            
            $data   = Cache::rememberForever('CheckTempMail_list_' . $cachek, function () use ($path) {
                return collect(explode("\n", file_get_contents($path)));
            });
            
            return
            !$data->contains(function($value, $key) use($domain, $tld){
                return ($value == $domain) || ($value == "*.$tld");
            });

        }, Lang::has("validation.tempmail") ? trans("validation.tempmail") : $this->message);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     * 
     * @return array
     */
    public function provides()
    {
        return ['laravel-tempmail'];
    }
}
