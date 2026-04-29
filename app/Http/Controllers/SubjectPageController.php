<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\SubjectPage;
use Illuminate\Validation\Rule;
use App\Services\HomePageDataService;

class SubjectPageController extends Controller
{
    protected $homeData;

    public function __construct(HomePageDataService $homeData)
    {
        $this->homeData = $homeData;
    }

    function generateOrganizationSchema()
    {
        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "WTS Visa Consultancy",
            "url" => "https://wtsvisa.com",
            "logo" => "https://wtsvisa.com/new-home-images/wts-logo.png",
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => "+44 7435256433",
                "contactType" => "Customer Service",
                "availableLanguage" => ["English"]
            ],
            "sameAs" => [
                "https://www.facebook.com/WTSvisaconsultancy",
                "https://www.instagram.com/wts_visaconsultancy/",
            ]
        ]);
    }
    function generateFaqSchema(array $faqEntries): string
    {
        $mainEntity = array_map(fn($entry) => [
            "@type" => "Question",
            "name" => $entry['question'],
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $entry['answer']
            ]
        ], $faqEntries);

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $mainEntity
        ]);
    }

    function BreadcrumbList(array $breadcrumbs): string
    {
        $breadcrumbSchema = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => []
        ];

        foreach ($breadcrumbs as $position => $breadcrumb) {
            $breadcrumbSchema['itemListElement'][] = [
                "@type" => "ListItem",
                "position" => $position + 1,
                "name" => $breadcrumb['name'],
                "item" => $breadcrumb['url']
            ];
        }

        // Return as a JSON string
        return json_encode($breadcrumbSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    function artical($title, $description, $pdalishDate, $updalishDate)
    {
        return json_encode([
            "@context" => "http://schema.org",
            "@type" => "Article",
            "image" => "https://wtsvisa.com/new-home-images/wts-logo.png",


            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => env('CANONICAL_URL', url()->current()) ?? ""
            ],
            "headline" => $title ?? "",
            "datePublished" => $pdalishDate ?? "",
            "dateModified" => $updalishDate ?? "",
            "author" => [
                "@type" => "Organization",
                "name" => "WTSVisaConsultancy",
                "url" => "https://wtsvisa.com",
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => 'WTSVisaConsultancy',

            ],
            "description" => $description
        ], JSON_UNESCAPED_SLASHES);
    }
    public function getSubjectBySlug($slug)
    {

        $data['SubjectPage'] = SubjectPage::where('slug', $slug)->where('status', 'publish')->first();

        // Check if exists
        if (!$data['SubjectPage']) {
            abort(404); // Or handle the case where the subject with the given slug is not found
        }


        $data['title'] = $data['SubjectPage']->meta_title;
        $data['description'] = $data['SubjectPage']->meta_description;
        $data['keyword'] = $data['SubjectPage']->meta_tag;
        $data['canonical'] = 'https://wtsvisa.com/' . $data['SubjectPage']->slug;
        if ($data['SubjectPage']->faq) {

            $faqs = json_decode($data['SubjectPage']->faq, true);
            $data['Faqschema'] = $this->generateFaqSchema($faqs);


        } else {
            $data['Faqschema'] = $data['SubjectPage']->schema;
        }
        $canonical = 'https://wtsvisa.com/' . $data['SubjectPage']->slug;


        $data['artical'] = $this->Artical($data['SubjectPage']->title, $data['description'], $data['SubjectPage']->created_at, $data['SubjectPage']->updated_at);
        $data['org'] = $this->generateOrganizationSchema();

        $data['BreadcrumbList'] = $this->BreadcrumbList([
            ['name' => 'Home', 'url' => 'https://wtsvisa.com/'],
            ['name' => 'WTS Visa Consultancy', 'url' => 'https://wtsvisa.com/'],
            ['name' => $data['SubjectPage']->title, 'url' => 'https://wtsvisa.com/' . $slug]
        ]);

        $meta = [
            'title' => $data['SubjectPage']->meta_title ?? $data['SubjectPage']->title,
            'description' => $data['SubjectPage']->meta_description ?? Str::limit(strip_tags($data['SubjectPage']->content), 160),
            'keywords' => $data['SubjectPage']->meta_tag ?? '',
        ];
        $testimonials = $this->homeData->getTestimonials();
        return view("subject-pages.subject-detail", compact('data', 'meta', 'testimonials'));
    }

    public function subjectSitemap()
    {
        $subjects = SubjectPage::where('status', 'publish')->latest()->get();

        return response()
            ->view('subject-pages.subjectSitemap', compact('subjects'))
            ->header('Content-Type', 'text/xml');
    }
}