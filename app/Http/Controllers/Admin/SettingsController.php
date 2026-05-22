<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $siteType = Setting::get('site_type', 'clothing');

        return view('admin.settings.index', compact('siteType'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_type' => 'required|string|in:clothing,electronics',
        ]);

        Setting::updateOrCreate(
            ['key' => 'site_type'],
            ['value' => $validated['site_type']]
        );

        return redirect()->route('admin.settings.edit')->with('success', 'Site type saved successfully.');
    }
}
