<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\BlogsTestimonial;
use App\Models\BlogTestimonialPivot;
use App\Helpers\DefaultLanguage;
use App\Models\media;
use Illuminate\Http\Request;

class BlogsTestimonialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BlogsTestimonial::latest()->get();
        return view('management.blogs_testimonial.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.blogs_testimonial.create', compact('language'));
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
        if ($request->file('user_profile')) {
            $main_next = $request->file('user_profile')->getClientOriginalExtension();
            $user_file = 'user_profile' . time() . rand(1000, 14000000000) . '.' . $main_next;
            $request->user_profile->move(public_path('images/media'), $user_file);
        } else {
            $user_file = null;
        }
        $value = [
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'status' => $request->status,
            'user_profile' => $user_file,
        ];
        $blog_testimonial = BlogsTestimonial::create($value);
        $detail = [
            'blog_testimonial_id' => $blog_testimonial->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'trip_to' => $request->trip_to,
            'user_name' => $request->user_name,
            'user_city' => $request->user_city,
            'date' => $request->date,
        ];
        BlogTestimonialPivot::create($detail);
        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'blog_testimonial' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $blog_testimonial->id,
                        'reference_type' => 'blog_testimonial',
                        'image' => $main_file,
                    ];
                $multi = media::create($multi_image);
            }
        } else {
            $multi = null;
        }
        return redirect()->route('blogs-testimonial.show', $blog_testimonial->id)->with('success', 'Blogs Testimonial Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BlogsTestimonial $blogsTestimonial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogsTestimonial = BlogsTestimonial::find($id);
        $blogs_pivot = BlogTestimonialPivot::where('blog_testimonial_id',$id)->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type', 'blog_testimonial')->get();
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.blogs_testimonial.edit', compact('language', 'blogsTestimonial', 'blogs_pivot', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BlogsTestimonial $blogsTestimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogsTestimonial $blogsTestimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BlogsTestimonial $blogsTestimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $blogsTestimonial = BlogsTestimonial::find($id);
        $blogs_pivot = BlogTestimonialPivot::where('blog_testimonial_id',$id)->get()->first();
        media::where('reference_id', $id)->where('reference_type', 'blog_testimonial')->delete();;
        if ($request->file('user_profile')) {
            $main_next = $request->file('user_profile')->getClientOriginalExtension();
            $user_file = 'user_profile' . time() . rand(1000, 14000000000) . '.' . $main_next;
            $request->user_profile->move(public_path('images/media'), $user_file);
        } else {
            $user_file = $blogsTestimonial->user_profile;
        }
        $blogsTestimonial->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'status' => $request->status,
            'user_profile' => $user_file,
        ]);
        $blogs_pivot->update([
            'blog_testimonial_id' => $blogsTestimonial->id,
            'language_id' => $request->language_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'trip_to' => $request->trip_to,
            'user_name' => $request->user_name,
            'user_city' => $request->user_city,
            'date' => $request->date,
        ]);
        if ($request->file('image')) {
            foreach ($request->file('image') as $image) {
                $mainext = $image->getClientOriginalExtension();
                $main_file = 'blog_testimonial' . time() . rand(1000, 14000000000) . '.' . $mainext;
                $image->move(public_path('/images/media'), $main_file);
                $multi_image =
                    [
                        'reference_id' => $blogsTestimonial->id,
                        'reference_type' => 'blog_testimonial',
                        'image' => $main_file,
                    ];
                media::create($multi_image);
            }
        } else {
            foreach ($request->image_update as $image) {
                $multi_image =
                    [
                        'reference_id' => $blogsTestimonial->id,
                        'reference_type' => 'blog_testimonial',
                        'image' => $image,
                    ];
                media::create($multi_image);
            }
        }
        return redirect()->back()->with('success', 'Blogs Testimonial Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BlogsTestimonial $blogsTestimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        media::where('reference_id', $id)->where('reference_type', 'blog_testimonial')->delete();
        BlogsTestimonial::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Blogs Testimonial Delete successfully');
    }
}
