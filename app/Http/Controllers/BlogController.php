<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function blog(Request $request)
    {
        $blogs = Blog::where('type', 'blog')
            ->where('site', 'wts')
            ->where('status', 'publish')
            ->orderByDesc('id')
            ->paginate(5);

        $canonical = $request->has('page')
            ? 'https://wtsvisa.com/blog?page=' . $request->input('page')
            : 'https://wtsvisa.com/blog';

        $meta = [
            'title' => 'Study Abroad Consultants | Expert Guidance for Students',
            'description' => 'Explore expert tips, guides, and latest updates on studying abroad. WTS Study Abroad Consultant blogs help students choose courses, universities, and countries.',
            'keywords' => 'visa blogs, study abroad blogs, uk visa blog, canada visa blog, australia visa blog, student visa guidance, immigration updates, wts visa consultancy blogs',
            'canonical' => $canonical,
        ];

        $data = [
            'canonical' => $canonical,
        ];

        return view('blog.blog-list', compact('blogs', 'data', 'meta'));
    }

    public function getBlogBySlug($slug)
    {
        // $data['blog'] = Blog::find($id);

        $data['blog'] = Blog::where('slug', $slug)->where('status', 'publish')->first();
        $data['recent_post'] = Blog::where('type', 'blog')->where('status', 'publish')->latest()->take(5)->get();

        // Check if the blog exists
        if (!$data['blog']) {
            abort(404); // Or handle the case where the blog with the given slug is not found
        }


        $data['title'] = $data['blog']->meta_title;
        $data['description'] = $data['blog']->meta_discribtion;
        $data['keyword'] = $data['blog']->meta_tag;
        $data['canonical'] = 'https://wtsvisa.com/blog/' . $data['blog']->slug;
        if ($data['blog']->faq) {

            $faqs = json_decode($data['blog']->faq, true);
            $data['Faqschema'] = $this->generateFaqSchema($faqs);


        } else {
            $data['Faqschema'] = $data['blog']->schema;
        }
        $canonical = 'https://wtsvisa.com/' . $data['blog']->slug;


        $data['artical'] = $this->Artical($data['blog']->title, $data['description'], $data['blog']->created_at, $data['blog']->updated_at);
        $data['org'] = $this->generateOrganizationSchema();

        $data['BreadcrumbList'] = $this->BreadcrumbList([
            ['name' => 'Home', 'url' => 'https://wtsvisa.com/'],
            ['name' => 'WTS Visa Consultancy Blogs', 'url' => 'https://wtsvisa.com/blog'],
            ['name' => $data['blog']->title, 'url' => 'https://wtsvisa.com/blog/' . $slug]
        ]);

        $meta = [
            'title' => $data['blog']->meta_title ?? $data['blog']->title,
            'description' => $data['blog']->meta_discribtion ?? Str::limit(strip_tags($data['blog']->content), 160),
            'keywords' => $data['blog']->meta_tag ?? '',
        ];

        return view("blog.blog-detail", compact('data', 'meta'));
    }

    public function blogSitemap()
    {
        $blogs = Blog::where('type', 'blog')
            ->where('site', 'wts')
            ->where('status', 'publish')
            ->select('created_at', 'images', 'slug', 'title')
            ->get();

        return response()
            ->view('blog.blogSitemap', ['blogs' => $blogs])
            ->header('Content-Type', 'text/xml');
    }

    public function loadMore(Request $request)
    {
        $offset = (int) $request->get('offset', 0);
        $limit = 4;

        $baseQuery = Blog::where('type', 'blog')
            ->where('site', 'wts')
            ->where('status', 'publish');

        $blogs = (clone $baseQuery)
            ->orderByDesc('id')
            ->skip($offset)
            ->take($limit)
            ->get();

        $totalBlogs = (clone $baseQuery)->count();

        return response()->json([
            'html' => view('blog.blog-cards', compact('blogs'))->render(),
            'hasMore' => $totalBlogs > ($offset + $limit),
        ]);
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

    public function searchBlogs(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $blogs = Blog::where('type', 'blog')
            ->where('site', 'wts')
            ->where('status', 'publish')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%');
            })
            ->orderByRaw("
            CASE 
                WHEN title LIKE ? THEN 1
                WHEN title LIKE ? THEN 2
                ELSE 3
            END
        ", [$query . '%', '%' . $query . '%'])
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'slug', 'images', 'created_at')
            ->limit(10)
            ->get();

        $baseUrl = config('app.backend_url');

        $results = $blogs->map(function ($blog) use ($baseUrl) {
            return [
                'title' => $blog->title,
                'url' => url('/blog/' . $blog->slug),
                'image' => $blog->images
                    ? $baseUrl . '/' . ltrim($blog->images, '/')
                    : $baseUrl . '/default.jpg',
                'date' => $blog->created_at->format('F j, Y'),
            ];
        });

        return response()->json(['results' => $results]);
    }
}
