<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRoleEditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && User::isEditor($user)) return $next($request);
        return back()->withErrors(['message' => 'No autenticado o sin permisos de edición.']);
    }
}
