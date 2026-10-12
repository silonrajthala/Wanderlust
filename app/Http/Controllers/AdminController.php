<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {

        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function updateHeroImages(Request $request)
    {
        $request->validate([
            'hero_images' => 'required|array',
            'hero_images.*.title' => 'required|string|max:255',
            'hero_images.*.subtitle' => 'required|string|max:500',
            'hero_images.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $heroImages = [];

        foreach ($request->hero_images as $index => $heroImage) {
            $imagePath = null;

            if (isset($heroImage['image']) && $heroImage['image']->isValid()) {
                $imagePath = $heroImage['image']->store('hero-images', 'public');
            } else {
                // Keep existing image if no new image uploaded
                $imagePath = $heroImage['existing_image'] ?? null;
            }

            $heroImages[] = [
                'title' => $heroImage['title'],
                'subtitle' => $heroImage['subtitle'],
                'image_path' => $imagePath,
            ];
        }

        // Save to database or config file
        Storage::disk('local')->put('hero-images.json', json_encode($heroImages));

        return back()->with('success', 'Hero images updated successfully!');
    }

    public function updateContent(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'about_content' => 'required|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        Storage::disk('local')->put('site-config.json', json_encode($validated));

        return back()->with('success', 'Site content updated successfully!');
    }
}
