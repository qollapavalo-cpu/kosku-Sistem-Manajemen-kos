<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login, atau role-nya tidak sesuai parameter, tolak aksesnya!
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}