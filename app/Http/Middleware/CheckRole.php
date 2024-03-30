<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user=Auth::class;
        // if (auth()->user()->$request->is_admin==false) {
        //     return redirect('welcome');
        // }
        // return $next($request);

        //جلب السمتخدم المسجل دخوله حاليا
        $user=Auth::user();
        //وضع الشرط للولوجالى صفحات الادمن ان يكون مسجل دخوله ونوعه ادمن
        if ($user &&  $user->is_admin == true) 
        {

            return $next($request);
            //return redirect()->route('admin.index');
            
        }
        else
        {
            //return abort(404);
            return response()->json(['You do not have permission to access for this page.']);
            
            // return redirect()->back();
            //return redirect('/');//نضع مسارurl

        }
     
            
            
    }
}
