<?php

namespace App\Http\Middleware;
use Closure;

class SecureHeadersMiddleware
{
    // Enumerate headers which you do not want in your application's responses.
    // Great starting point would be to go check out @Scott_Helme's:
    // https://securityheaders.com/
    private $unwantedHeaderList = [
        'X-Powered-By',
        'x-powered-by',
        'Server',
        'server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Expect-CT', 'enforce, max-age=30');
        $response->headers->set('Strict-Transport-Security', 'max-age:31536000; includeSubDomains');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://*.googleapis.com https://*.gstatic.com *.google.com https://*.ggpht.com *.googleusercontent.com https://*.googletagmanager.com blob:; style-src 'self' 'unsafe-inline'; img-src 'self' * data:; font-src 'self' data: https://*.gstatic.com https://*.fontawesome.com; connect-src 'self' https://*.fontawesome.com https://*.gstatic.com https://*.googleapis.com *.google.com https://*.gstatic.com  data: blob:; media-src 'self'; frame-src 'self' *.google.com github.com *.youtube.com *.vimeo.com; object-src 'none'; base-uri 'self'; report-uri");
        $response->headers->set('Permissions-Policy', 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()');
   return $response;
    }
    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}