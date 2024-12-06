<?php

namespace App\Http\Controllers;

use App\Models\EventCustomers;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StripeController extends Controller
{

    public function index(Request $request)
    {
        $id = $request->query('id');

        $data['customerRecord'] = EventCustomers::find($id);

        // dd($data['customerRecord']);

        return view('index', $data);
    }

    public function checkout(Request $request)
    {
        $id = $request->query('id');
        $price = $request->price * 100;

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        // 'currency' => 'gbp',
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!!',
                        ],
                        'unit_amount' => $price, // £5.00
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return view('index');
    }


    public function home(Request $request)
    {
        // Define the packages
        $packages = [
            895 => [
                'title' => "x1 Launch Essentials",
                'description' => "Get your business started with a custom logo, brand identity, social media setup, and initial content to build your presence."
            ],
            1395 => [
                'title' => "x1 Build & Scale",
                'description' => "Take your brand to the next level with enhanced branding, a basic website, short videos, and business consultation to fuel growth."
            ],
            '1895packagefbl' => [
                'price' => "1895",
                'title' => "x1 Full Brand Launch",
                'description' => "Comprehensive brand development with an advanced website, social media management, and email marketing to scale quickly."
            ],
            '1895packagedge' => [
                'title' => "x1 Digital Growth & Expansion",
                'description' => "Accelerate your digital growth and expansion with data-driven strategies and innovative solutions. We help you scale your online presence and reach new audiences effectively."
            ],
            1195 => [
                'title' => "x1 Social Media & Content",
                'description' => "Boost your online presence with tailored social media strategies and engaging content that connects with your audience. We help your brand shine across all platforms."
            ],
            '1595packageom' => [
                'title' => "x1 Operations & Marketing",
                'description' => "Streamline your business operations and amplify growth with effective marketing strategies. We align your processes and promotions to drive efficiency and success."
            ],
            '1595packagero' => [
                'title' => "x1 Rebranding & Optimization",
                'description' => "Revitalize your brand with our rebranding and optimization services. We refine your identity and strategies to enhance market impact and improve performance."
            ],
            1995 => [
                'title' => "x1 Market Growth & Development",
                'description' => "Unlock new opportunities with our market growth and development solutions. We help expand your business into new territories and drive sustainable success."
            ],
            2395 => [
                'title' => "x1 Market Leadership",
                'description' => "Position your brand at the forefront with our market leadership services. We craft strategies that elevate your influence and establish you as an industry leader."
            ],
            999 => [
                'title' => "x1 Web Development",
                'description' => "Our comprehensive web development package delivers custom-coded, scalable websites built for performance and user engagement."
            ],
            1 => [
                'title' => "x1 Web Development",
                'description' => "Our comprehensive web development package delivers custom-coded, scalable websites built for performance and user engagement."
            ]
        ];

        // Retrieve the price query parameter
        $price = $request->query('price');

        // Check if the price exists in the packages array
        if (!isset($packages[$price])) {
            // Return a 404 page if the price is invalid
            abort(404, 'Page not found');
        }

        // Get the title and description for the given price
        $title = $packages[$price]['title'];
        $description = $packages[$price]['description'];

        // Pass data to the view
        return view('home', compact('price', 'title', 'description'));
    }


    public function customerEvent(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'figma' => 'required|string',
            'price' => 'required|numeric',
            'figma_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust allowed file types and size as needed
        ]);

        // Handle file upload if present
        $figma_file = null;
        if ($request->hasFile('figma_file')) {
            $file = $request->file('figma_file');
            $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/images'), $filename);
            $figma_file = $filename;
        }

        // Insert data into the database
        $eventData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'figma' => $validated['figma'],
            'price' => $validated['price'],
            'figma_file' => $figma_file,
            'created_at' => new DateTime('now', new DateTimeZone('Asia/Karachi')),
        ];

        $inserted = EventCustomers::insertGetId($eventData);

        // Prepare the response
        return response()->json([
            'status' => $inserted ? true : false,
            'msg' => $inserted ? 'Event added successfully!' : 'Sorry, Event not added.',
            'id' => $inserted ?? null,
        ]);
    }
}
