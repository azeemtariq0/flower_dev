<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\BlogDetail;
use App\Models\categories;
use App\Models\Language;
use App\Models\seo;
use App\Models\media;
use App\Helpers\DefaultLanguage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = blog::leftJoin('media', function ($join) {
            $join->on('blogs.id', '=', 'media.reference_id');
        })
            ->leftjoin('blog_details', function ($join) {
                $join->on('blogs.id', '=', 'blog_details.blog_id');
            })
            ->where('media.reference_type', '=', 'post')
            ->where('blog_details.language_id', DefaultLanguage::SelectedLanguage()->id)
            ->select('blogs.id', 'blogs.user_id', 'blogs.slug', 'blogs.status', 'blog_details.title', 'blog_details.short_description', 'blog_details.long_description', 'blog_details.language_id', 'media.image')
            ->get();
        return view('management.blog.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.blog.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        if ($request->file('image')) {
            $mainext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'post' . time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = null;
        }
        $data = [
            'title' => $request->title,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ];
        $categories = blog::create($data);
        $blog_detail = [
            'title' => $request->title,
            'blog_id' => $categories->id,
            'language_id' => $request->language_id,
            'long_description' => $request->long_description,
            'short_description' => $request->short_description,
        ];
        $detail = BlogDetail::create($blog_detail);
        $multi_image =
            [
                'reference_id' => $categories->id,
                'reference_type' => 'post',
                'image' => $main_file,
            ];
        $multi = media::create($multi_image);
        $seo = [
            'reference_id' => $categories->id,
            'language_id' => $request->language_id,
            'reference_type' => 'post',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        $search = seo::create($seo);
        return redirect()->route('post.show', $categories->id)->with('success', 'Pages Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = blog::where('id', $id)->get()->first();
        $blogsDetail = BlogDetail::where('blog_id', $id)->get()->first();
        $seo = seo::where('reference_id', $id)->where('reference_type', 'post')->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'post')->get()->first();
        $language = Language::where('id', $blogsDetail->language_id)->get()->first();
        return view('management/blog/edit', compact('category', 'language', 'seo', 'media', 'blogsDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blogs = blog::where('id', $id)->get()->first();
        $blogsDetail = BlogDetail::where('blog_id', $id)->get()->first();
        $multi = media::where('reference_id', $id)->where('reference_type', 'post')->get()->first();
        if ($request->file('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $main_file = 'post' . time() . rand(1000, 14000000000) . '.' . $ext;
            $request->image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = $multi->image;
        }

        $blogs->update([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        $blogsDetail->update([
            'title' => $request->title,
            'blog_id' => $blogs->id,
            'language_id' => $request->language_id,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        if ($multi != null) {
            $multi->update([
                'image' => $main_file,
            ]);
        } else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'post',
                    'image' => $main_file,
                ];
            media::create($multi_image);
        }
        $seo = seo::where('reference_id', $blogs->id)->get()->first();
        $seo->update([
            'reference_id' => $blogs->id,
            'language_id' => $request->language_id,
            'meta_title' => $request->meta_title,
            'reference_type' => 'post',
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);
        return redirect()->back()->with('success', 'Pages Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        blog::where('id', $id)->delete();
        seo::where('reference_id', $id)->delete();
        return redirect()->back()->with('success', 'Pages Deleted Successfully');
    }
}
