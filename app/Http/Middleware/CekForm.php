<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CekForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $toolsDocuments = $request->session()->get('document');
        $toolsSafeties = $request->session()->get('safety');
        $toolsEngines = $request->session()->get('engine');
        $toolsTools = $request->session()->get('tools');

        // Cek apakah ada input yang kosong
        if ($toolsDocuments && $toolsSafeties && $toolsEngines && $toolsTools) {
            return $next($request);
        }
        
        return redirect()->route('formTools')->with('error', 'Pastikan semua input terisi.');
        
    }

}
