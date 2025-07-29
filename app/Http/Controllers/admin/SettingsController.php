<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {   
        $setting = Settings::all()->pluck('value','key')->toArray();
        return view('admin.settings',compact('setting'));
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'site_name'             => 'required|string|max:255',
            'site_description'      => 'nullable|string|max:500',
            'site_keywords'         => 'nullable|string|max:255',
            'site_author'           => 'nullable|string|max:255',
            'site_email'            => 'required|email|max:255',
            'site_phone'            => 'nullable|string|max:255',
            'facebook_link'         => 'nullable|url|max:255',
            'twitter_link'          => 'nullable|url|max:255',
            'linkedin_link'         => 'nullable|url|max:255',
            'instagram_link'        => 'nullable|url|max:255',
            'maintenance_mode'      => 'required|boolean',
            'maintenance_mode_text' => 'nullable|string|max:500',
        ]);

        foreach ($validation as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        dd(Settings::pluck('value', 'key')->toArray()); // To see updated values
        //return redirect()->back()->with('success', 'Settings updated successfully.');
    }

}
