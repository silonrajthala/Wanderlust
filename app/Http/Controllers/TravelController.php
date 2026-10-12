<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TravelController extends Controller
{
        public function index()
    {
        // Hero section images
        $heroImages = [
            [
                'url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'title' => 'Discover Paradise Beaches',
                'subtitle' => 'Experience the world\'s most beautiful coastal destinations'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'title' => 'Mountain Adventures',
                'subtitle' => 'Embark on thrilling journeys to majestic peaks'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&auto=format&fit=crop&w=2068&q=80',
                'title' => 'Cultural Experiences',
                'subtitle' => 'Immerse yourself in rich traditions and heritage'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1439066615861-d1af74d74000?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'title' => 'Luxury Getaways',
                'subtitle' => 'Indulge in premium accommodations and services'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'title' => 'City Explorations',
                'subtitle' => 'Discover the vibrant life of world-class cities'
            ]
        ];

                // About section data
        $aboutData = [
            'title' => 'About Wanderlust Travel',
            'subtitle' => 'Crafting Unforgettable Journeys Since 2012',
            'description' => 'For over a decade, Wanderlust Travel has been transforming travel dreams into extraordinary realities. We are passionate about creating personalized experiences that go beyond typical tourism.',
            'features' => [
                [
                    'icon' => 'fas-award',
                    'title' => 'Award Winning',
                    'description' => 'Recognized as Best Travel Agency 2023'
                ],
                [
                    'icon' => 'fas-globe-americas',
                    'title' => 'Global Network',
                    'description' => 'Partners in 50+ countries worldwide'
                ],
                [
                    'icon' => 'fas-user-shield',
                    'title' => '24/7 Support',
                    'description' => 'Round-the-clock customer assistance'
                ],
                [
                    'icon' => 'fas-hand-holding-heart',
                    'title' => 'Personalized Service',
                    'description' => 'Tailored itineraries for every traveler'
                ]
            ],
            'team' => [
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Founder & CEO',
                    'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'experience' => '15+ years in travel industry'
                ],
                [
                    'name' => 'Michael Chen',
                    'position' => 'Travel Director',
                    'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'experience' => '12+ years expertise'
                ],
                [
                    'name' => 'Emily Rodriguez',
                    'position' => 'Luxury Travel Specialist',
                    'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'experience' => '10+ years in luxury travel'
                ]
            ],
            'stats' => [
                [
                    'number' => '15,000+',
                    'label' => 'Happy Travelers'
                ],
                [
                    'number' => '50+',
                    'label' => 'Destinations'
                ],
                [
                    'number' => '12',
                    'label' => 'Years Experience'
                ],
                [
                    'number' => '98%',
                    'label' => 'Satisfaction Rate'
                ]
            ]
        ];

        // Mock data for destinations, packages, etc.
        $destinations = [
            [
                'id' => 1,
                'name' => 'Bali, Indonesia',
                'image' => 'bali.jpg',
                'price' => 1299,
                'duration' => '7 days',
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'name' => 'Santorini, Greece',
                'image' => 'santorini.jpg',
                'price' => 1899,
                'duration' => '5 days',
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'name' => 'Tokyo, Japan',
                'image' => 'tokyo.jpg',
                'price' => 2199,
                'duration' => '10 days',
                'rating' => 4.7
            ],
            [
                'id' => 4,
                'name' => 'Paris, France',
                'image' => 'paris.jpg',
                'price' => 1599,
                'duration' => '6 days',
                'rating' => 4.6
            ]
        ];

        $packages = [
            [
                'name' => 'Luxury Getaway',
                'icon' => 'fas-hotel',
                'description' => '5-star accommodations with premium amenities'
            ],
            [
                'name' => 'Family Vacation',
                'icon' => 'fas-users',
                'description' => 'Family-friendly destinations and activities'
            ],
            [
                'name' => 'Adventure Tour',
                'icon' => 'fas-hiking',
                'description' => 'Thrilling experiences for adventure seekers'
            ],
            [
                'name' => 'Cultural Experience',
                'icon' => 'fas-monument',
                'description' => 'Immerse in local culture and traditions'
            ]
        ];

        return view('index', compact('heroImages','aboutData', 'destinations', 'packages'));
    }

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'travelers' => 'required|integer|min:1',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fix the errors in the form.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Integrate with CRM

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your inquiry! Our travel expert will contact you within 24 hours.'
        ]);
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email'
        ]);

        // Save newsletter subscription
        // NewsletterSubscription::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!'
        ]);
    }
}
