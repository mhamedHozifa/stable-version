<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Contracts\Support\Arrayable;

class ThemeResolver
{
    public function currentSiteType(): string
    {
        return Setting::get('site_type', config('themes.default', 'clothing'));
    }

    public function currentTheme(): array
    {
        return config('themes.themes.' . $this->currentSiteType(), []);
    }

    public function view(string $page, ?string $fallback = null): string
    {
        return $this->resolve('views', $page, $fallback ?: $this->defaultView($page));
    }

    public function cssPath(string $page, ?string $fallback = null): string
    {
        return $this->resolve('css', $page, $fallback ?: 'css/shop.css');
    }

    protected function resolve(string $section, string $page, string $fallback): string
    {
        $theme = $this->currentTheme();

        return data_get($theme, "$section.$page", $fallback);
    }

    protected function defaultView(string $page): string
    {
        return match ($page) {
            'cart' => 'cart.index',
            'checkout' => 'cart.checkout',
            'product' => 'products.show',
            default => 'products.index',
        };
    }
}
