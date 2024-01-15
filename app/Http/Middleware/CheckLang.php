<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CheckLang
{
    use generalTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check  language in header lang ==> en 
        $lang = $request->header('lang'); //en
        $supportedLanguages= ['en','ar'];
        // if(isset($lang)){
        //     if(in_array($lang, $supportedLanguages)){
        //         App::setLocale($lang);
        //         return $next($request);
        //     }else{
        //         return $this->returnErrorMessage("Not supported lang", 400);
        //     }
        // }else{
        //     return $this->returnErrorMessage("You Must send lang", 422);
        // }
        if(empty($lang)){
            return $this->returnErrorMessage("You Must send lang", 422);
        }
        if(!in_array($lang,$supportedLanguages)){
            return $this->returnErrorMessage("Not supported lang", 400);
        }
        App::setLocale($lang);
        return $next($request);
    }
}
