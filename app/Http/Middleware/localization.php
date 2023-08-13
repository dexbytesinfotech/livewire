<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale((\Session::get('locale') ? \Session::get('locale') :  app()->getLocale()));
        $this->languages = \App\Dexlib\Locale::getAllLang();
        $this->lang = isset(request()->ref_lang) ? isset($this->languages[request()->ref_lang]) ?  request()->ref_lang : app()->getLocale() : app()->getLocale();
        $lang = in_array($this->lang,config('translatable.locales')) ? $this->lang : app()->getLocale();
        $this->language = $this->languages[$lang];
        request()->merge([
            'ref_lang' => $lang,
            'language' => $this->language
        ]);
        return $next($request);
    }
}
