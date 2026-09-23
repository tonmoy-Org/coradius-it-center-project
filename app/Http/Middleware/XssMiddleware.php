<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XssMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userInput = $request->all();

        $exceptKeys = [
            'custom_lead_form',
            'custom_header_script',
            'custom_footer_script',
            'custom_css',
            'custom_js',
            'fb_pixel_id',
            'google_analytics_id',
            'header_script',
            'footer_script',
        ];

        array_walk_recursive($userInput, function (&$val, $key) use ($exceptKeys) {
            if (is_string($val) && !in_array($key, $exceptKeys, true)) {
                $val = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $val);
                $val = preg_replace('#&lt;script(.*?)gt;(.*?)&lt;/script&gt;#is', '', $val);
            }
        });

        $request->merge($userInput);

        return $next($request);
    }
}
