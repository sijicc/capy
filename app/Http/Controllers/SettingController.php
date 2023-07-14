<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Setting::class);

        return Setting::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Setting::class);

        $request->validate([

        ]);

        return Setting::create($request->validated());
    }

    public function show(Setting $setting)
    {
        $this->authorize('view', $setting);

        return $setting;
    }

    public function update(Request $request, Setting $setting)
    {
        $this->authorize('update', $setting);

        $request->validate([

        ]);

        $setting->update($request->validated());

        return $setting;
    }

    public function destroy(Setting $setting)
    {
        $this->authorize('delete', $setting);

        $setting->delete();

        return response()->json();
    }
}
