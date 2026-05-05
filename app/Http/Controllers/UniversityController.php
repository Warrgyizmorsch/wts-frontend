<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\HomePageDataService;
use App\Models\AppliedUniversity;
use App\Models\University;
use App\Models\Course;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Leads;
use App\Models\User;

class UniversityController extends Controller
{

    protected $homeData;

    public function __construct(HomePageDataService $homeData)
    {
        $this->homeData = $homeData;
    }


public function courseFinder(Request $request)
{
    $countryMap = [
        'usa' => ['usa', 'united states'],
        'united states' => ['usa', 'united states'],
        'uk' => ['uk', 'united kingdom'],
        'united kingdom' => ['uk', 'united kingdom'],
        'uae' => ['uae', 'united arab emirates'],
        'united arab emirates' => ['uae', 'united arab emirates'],
        'australia' => ['australia'],
        'canada' => ['canada'],
        'ireland' => ['ireland'],
        'malaysia' => ['malaysia'],
        'new zealand' => ['new zealand'],
        'singapore' => ['singapore'],
    ];

    $streamMap = [
        'MBA' => ['mba', 'business administration'],
        'Engineering' => ['engineering'],
        'Computer Science / IT' => ['computer', 'software', 'it'],
        'Data Science' => ['data', 'analytics'],
        'Nursing' => ['nursing'],
        'Medicine' => ['medical', 'medicine'],
        'Science' => ['science'],
        'Arts & Humanities' => ['arts', 'humanities'],
        'Management' => ['management'],
        'Law' => ['law'],
        'Hospitality' => ['hospitality', 'hotel'],
        'Architecture' => ['architecture'],
    ];

    // Define professional duration buckets in months
    $durationBuckets = [
        '0-1 year'   => [0, 12],
        '1-2 years'  => [13, 24],
        '2-3 years'  => [25, 36],
        '3-4 years'  => [37, 48],
        '4-5 years'  => [49, 60],
        '5+ years'   => [61, 999],
    ];

    $baseQuery = Course::with('university');
    $dataQuery = Course::with('university');

    /* TOP FILTERS */
    if ($request->filled('country')) {
        $country = strtolower($request->country);
        if (isset($countryMap[$country])) {
            $baseQuery->whereHas('university', function ($q) use ($countryMap, $country) {
                $q->whereIn('country', $countryMap[$country]);
            });
        }
    }

    if ($request->filled('city')) {
        $city = strtolower($request->city);

        $baseQuery->whereHas('university', function ($q) use ($city) {
            $q->whereRaw('LOWER(city) LIKE ?', ["%{$city}%"]);
        });
    }


    if ($request->filled('course')) {
        $baseQuery->where('course_name', 'like', '%' . $request->course . '%');
    }

    /* SIDEBAR FILTERS */
    if ($request->filled('stream')) {
        $selectedStreams = $request->stream;

        $baseQuery->where(function ($q) use ($selectedStreams, $streamMap) {
            foreach ($selectedStreams as $stream) {
                if (!isset($streamMap[$stream])) continue;

                foreach ($streamMap[$stream] as $keyword) {
                    $q->orWhere('course_name', 'LIKE', "%{$keyword}%");
                }
            }
        });
    }

    if ($request->filled('course_type')) {
        $baseQuery->whereIn('course_type', $request->course_type);
    }

    if ($request->filled('duration')) {
        $selectedRanges = $request->duration;

        $baseQuery->where(function($q) use ($selectedRanges, $durationBuckets) {
            foreach ($selectedRanges as $range) {
                if (!isset($durationBuckets[$range])) continue;
                [$min, $max] = $durationBuckets[$range];

                $q->orWhereRaw("
                    (
                        (LOWER(duration) LIKE '%week%' AND CEIL(SUBSTRING_INDEX(duration, ' ', 1)/4) BETWEEN ? AND ?)
                        OR (LOWER(duration) LIKE '%month%' AND SUBSTRING_INDEX(duration, ' ', 1) BETWEEN ? AND ?)
                        OR (LOWER(duration) LIKE '%year%' AND SUBSTRING_INDEX(duration, ' ', 1)*12 BETWEEN ? AND ?)
                        OR (LOWER(duration) REGEXP '[0-9]+ *(year|month).* / *[0-9]+ *(year|month)' AND
                            (
                                (SUBSTRING_INDEX(duration, ' ', 1) * 12) + 
                                (SUBSTRING_INDEX(SUBSTRING_INDEX(duration, '/', -1), ' ', 1))
                            ) BETWEEN ? AND ?
                        )
                    )
                ", [$min,$max,$min,$max,$min,$max,$min,$max]);
            }
        });
    }

    if ($request->filled('fee')) {
        $baseQuery->where(function ($q) use ($request) {
            foreach ($request->fee as $range) {
                [$min, $max] = explode('-', $range);
                $q->orWhereBetween('tuition_fee', [(int)$min, (int)$max]);
            }
        });
    }

    if ($request->filled('university')) {
        $baseQuery->whereIn('university_id', $request->university);
    }

    /* INTAKE MONTH FILTER */
    // if ($request->filled('intake_month')) {

    //     $month = strtolower($request->intake_month);

    //     $baseQuery->whereHas('university', function ($q) use ($month) {
    //         $q->whereRaw("LOWER(intake) LIKE ?", ["%{$month}%"]);
    //     });
    // }
    if ($request->filled('intake_month') || $request->filled('intake_year')) {

        $baseQuery->whereHas('university', function ($q) use ($request) {

            $q->whereNotNull('intake')
            ->where('intake', '!=', '');

            if ($request->filled('intake_month')) {

                $month = strtolower($request->intake_month);

                $q->whereRaw("LOWER(intake) LIKE ?", ["%{$month}%"]);
            }

        });
    }



    /* RESULTS */
    // $universities = (clone $baseQuery)
    //     ->orderBy('id', 'desc')
    //     ->paginate(6)
    //     ->withQueryString();
    $sortedQuery = clone $baseQuery;

    /* SORTING */
    if ($request->filled('sort')) {

        if ($request->sort === 'fee_low') {
            $sortedQuery->orderBy('tuition_fee', 'asc');
        }

        elseif ($request->sort === 'fee_high') {
            $sortedQuery->orderBy('tuition_fee', 'desc');
        }

    } else {
        $sortedQuery->orderBy('id', 'desc'); // default
    }

    $universities = $sortedQuery
        ->paginate(6)
        ->withQueryString();


    $totalCourses = (clone $baseQuery)->count();

    /* STREAM COUNTS */
    $streams = collect();

    foreach ($streamMap as $streamName => $keywords) {
        $count = (clone $dataQuery)
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('course_name', 'LIKE', "%{$word}%");
                }
            })
            ->count();

        if ($count > 0) {
            $streams->push((object)[
                'name' => $streamName,
                'total' => $count,
            ]);
        }
    }
    // Sort streams alphabetically (A-Z)
    $streams = $streams->sortBy('name')->values();

    /* COURSE TYPE COUNTS */
    $courseTypes = Course::selectRaw("
        TRIM(course_type) as type,
        COUNT(*) as total
    ")
    ->whereNotNull('course_type')
    ->where('course_type', '!=', '')
    ->whereRaw("course_type NOT REGEXP '^[0-9]+$'")
    ->groupBy('type')
    ->orderBy('type')
    ->get();


    /* DURATION COUNTS */
    // Prepare CASE statements for SQL
    $caseSql = [];
    foreach ($durationBuckets as $label => [$min, $max]) {
        $caseSql[] = "WHEN (
            (LOWER(duration) LIKE '%week%' AND CEIL(SUBSTRING_INDEX(duration, ' ', 1)/4) BETWEEN $min AND $max)
            OR (LOWER(duration) LIKE '%month%' AND SUBSTRING_INDEX(duration, ' ', 1) BETWEEN $min AND $max)
            OR (LOWER(duration) LIKE '%year%' AND SUBSTRING_INDEX(duration, ' ', 1)*12 BETWEEN $min AND $max)
            OR (LOWER(duration) REGEXP '[0-9]+ *(year|month).* / *[0-9]+ *(year|month)' AND
                (
                    (
                        (SUBSTRING_INDEX(duration, ' ', 1) * 12) + 
                        (SUBSTRING_INDEX(SUBSTRING_INDEX(duration, '/', -1), ' ', 1)) 
                    ) BETWEEN $min AND $max
                )
            )
        ) THEN '$label'";
    }
    $caseSqlStr = implode(" ", $caseSql);

    // Query database to get counts per bucket
    $durations = Course::selectRaw("
        CASE
            $caseSqlStr
            ELSE NULL
        END as label,
        COUNT(*) as total
    ")
    ->whereNotNull('duration')
    ->groupBy('label')
    ->havingRaw('label IS NOT NULL')
    ->orderByRaw("
        CASE label
            WHEN '0-1 year' THEN 1
            WHEN '1-2 years' THEN 2
            WHEN '2-3 years' THEN 3
            WHEN '3-4 years' THEN 4
            WHEN '4-5 years' THEN 5
            WHEN '5+ years' THEN 6
            ELSE 999
        END
    ")
    ->get();

    /* UNIVERSITY COUNTS (A–Z, NO DUPLICATE) */
    $universitiesList = Course::join('university', 'courses.university_id', '=', 'university.id')
        ->select(
            'courses.university_id',
            'university.name as university_name'
        )
        ->selectRaw('COUNT(courses.id) as total')
        ->groupBy('courses.university_id', 'university.name')
        ->orderBy('university.name')
        ->get();


    /* FEE COUNTS */
    $feeRanges = [
        '0-25000' => [0, 25000],
        '25000-50000' => [25000, 50000],
        '50000-100000' => [50000, 100000],
        '100000-99999999' => [100000, 99999999],
    ];

    $fees = collect($feeRanges)->map(function ($range, $key) use ($dataQuery) {
        return (object)[
            'key' => $key,
            'label' => match ($key) {
                '0-25000' => '0 - 25K',
                '25000-50000' => '25K - 50K',
                '50000-100000' => '50K - 1L',
                default => '1L+',
            },
            'total' => (clone $dataQuery)
                ->whereBetween('tuition_fee', $range)
                ->count(),
        ];
    });

    /* CITY LIST (for dropdown) */
    $cities = University::query()
        ->whereNotNull('city')
        ->where('city', '!=', '')
        ->get()
        ->pluck('city')
        ->map(fn ($city) => trim($city))
        ->filter()
        ->unique()
        ->sort()
        ->values();


    return view('course-finder', compact(
        'universities',
        'totalCourses',
        'streams',
        'courseTypes',
        'durations',
        'universitiesList',
        'fees',
        'cities'
    ));
}

    public function courseFinderPageLeadToCrm(Request $request)
    {
        $customMessages = [
            'name.required' => 'Full name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email.',

            'phone_number.main.required' => 'Please enter your phone number.',
            'phone_number.main.regex' => 'The phone number must be a 10-digit number.',

            'phone_number.full.required' => 'Please enter your full phone number.',
            'phone_number.full.regex' => 'The full phone number must be in international format.',

            'city.required' => 'City is required.',
            'course.required' => 'Course is required.',
            'intake.required' => 'Intake period is required.',
            // 'graduation_year.required' => 'Graduation year is required.',
        ];

        if ($request->has('phone_number.main')) {
            $request->merge([
                'phone_number' => [
                    'main' => ltrim($request->input('phone_number.main'), '0'),
                    'full' => $request->input('phone_number.full'),
                ]
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'phone_number.main' => 'required|string|regex:/^[0-9]{10}$/',
            'phone_number.full' => 'required|string|regex:/^\+[1-9]{1}[0-9]{3,14}$/',

            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'intake' => 'required|string|max:100',
            // 'graduation_year' => 'required|string|max:10',
            'page_url' => 'nullable|string',
        ], $customMessages);

        
        // Extract phone & country code
         
        $fullPhoneNumber = $validated['phone_number']['full'];
        $mainPhoneNumber = $validated['phone_number']['main'];

        $countryCode = substr(
            $fullPhoneNumber,
            0,
            strlen($fullPhoneNumber) - strlen($mainPhoneNumber)
        );

        // Create / Update User
        
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            $user = User::create([
                'name'         => $validated['name'],
                'email'        => $validated['email'],
                'contact_no'   => $mainPhoneNumber,
                'country_code' => $countryCode,
                'role_id'      => 2,
                'password'     => Hash::make('user@123'),
            ]);
        } else {
            $user->update([
                'name'         => $validated['name'],
                'contact_no'   => $mainPhoneNumber,
                'country_code' => $countryCode,
            ]);
        }

        // Default Lead Setup
        
        $defaultBucketId = 1;

        $defaultStatus = \DB::table('buckets')
            ->where('id', 2)
            ->value('name');

        // Create Lead (extra fields here)
        
        $lead = Leads::create([
            'lead_bucket_id' => $defaultBucketId,
            'lead_status'    => $defaultStatus,
            'lead_owner'     => null,
            'date'           => now()->format('Y-m-d'),
            'platform'       => 'Course Finder',
            'page_url'       => $request->page_url,

            // Course Finder specific
            'city'                           => $validated['city'],
            'whats_your_preferred_intake'    => $validated['intake'],
            'what_course_are_you_planning_to_study' => $validated['course'],
            // 'highest_completed'              => $validated['graduation_year'],

            // Optional defaults
            'uid'       => $user->id,
        ]);

        Session::put('visa_form_submitted', true);

        return response()->json([
            'success'  => true,
            'lead_id'  => $lead->id,
            'user_id'  => $user->id,
            'redirect_url' => route('thank-you'),
        ]);
    }

    public function landingPage(Request $request)
    
        {
        $countries = $this->homeData->getCountries();
        $testimonials = $this->homeData->getTestimonials();

        return view('landing-page',compact('countries', 'testimonials'));
    }

    public function ukStudyVisaConsultation(Request $request)
    
        {
        $countries = $this->homeData->getCountries();
        $testimonials = $this->homeData->getTestimonials();

        return view('landing-page2',compact('countries', 'testimonials'));
    }

    public function studyAbroadConsultant(Request $request)
    
        {
        $countries = $this->homeData->getCountries();
        $testimonials = $this->homeData->getTestimonials();

        return view('landing-page-study-abroad',compact('countries', 'testimonials'));
    }

    public function newHome(Request $request)
    {
        $countries = $this->homeData->getCountries();
        $testimonials = $this->homeData->getTestimonials();

        $blogs = Blog::where('site', '!=', 'warrgyizmorsch')->latest()->take(6)->get();

        return view('new-home', compact('countries', 'testimonials', 'blogs'));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|string',
            'course_title' => 'required|string',
            'university_id' => 'required|string',
        ]);

        // Prevent duplicate apply
        $exists = AppliedUniversity::where([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
        ])->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You already applied for this course'
            ], 409);
        }

        AppliedUniversity::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'course_title' => $request->course_title,
            'course_level' => $request->course_level,
            'duration' => $request->duration,
            'location' => $request->location,
            'tuition_fees' => $request->tuition_fees,
            'application_fees' => $request->application_fees,
            'university_id' => $request->university_id,
            'university_name' => $request->university_name,
            'currency_symbol' => $request->currency_symbol,
            'currency_code' => $request->currency_code,
            'status' => 'pending', // manual
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully.'
        ]);
    }

    private function normalizeCountry($country)
{
    $map = [
        'usa' => ['usa', 'us', 'united states', 'united states of america'],
        'uk' => ['uk', 'united kingdom', 'england', 'britain'],
        'australia' => ['australia', 'au'],
        'canada' => ['canada', 'ca'],
    ];

    $country = strtolower(trim($country));

    foreach ($map as $standard => $variants) {
        if (in_array($country, $variants)) {
            return $standard;
        }
    }

    return $country; // fallback
}

    public function showUniversity($country, $slug)
    {
        $normalizedCountry = $this->normalizeCountry($country);

        $university = University::with(['details', 'courses'])
            ->where('slug', $slug)
            ->whereHas('details', function ($q) {
                $q->where('status', 'published'); // ✅ only published
            })
            ->firstOrFail();

        // Normalize DB country
        $dbCountry = $this->normalizeCountry($university->country);

        // 🔥 Validate URL country matches DB
        if ($normalizedCountry !== $dbCountry) {
            abort(404);
        }

        return view('universities.university-details', [
            'university' => $university,
            'detail' => $university->details
        ]);
    }
}