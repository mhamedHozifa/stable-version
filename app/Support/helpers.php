<?php

use App\Services\ThemeResolver;

if (! function_exists('theme_view')) {
    function theme_view(string $page, ?string $fallback = null): string
    {
        return app(ThemeResolver::class)->view($page, $fallback);
    }
}

if (! function_exists('theme_css_path')) {
    function theme_css_path(string $page, ?string $fallback = null): string
    {
        return app(ThemeResolver::class)->cssPath($page, $fallback);
    }
}

if (! function_exists('theme_css')) {
    function theme_css(string $page, ?string $fallback = null): string
    {
        return asset(theme_css_path($page, $fallback));
    }
}
