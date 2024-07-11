<?php


namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\seo;
use App\Models\media;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::latest()->get();
        return  view('management.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',

            ]);
        if ($request->file('featured_image')) {
            $mainext = $request->file('featured_image')->getClientOriginalExtension();
            $main_file = 'pages'.time() . rand(1000, 14000000000) . '.' . $mainext;
            $request->featured_image->move(public_path('images/media'), $main_file);
        } else {
            $main_file = null;
        }
        $data = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description'=> $request->description,
            'featured_image'=> $main_file,
            'status' => $request->status,
        ];

        $pages = Pages::create($data);
        $multi_image=
            [
                'reference_id' => $pages->id,
                'reference_type'=>'pages',
                'image' => $main_file,
            ];
        $multi = media::create($multi_image);
        $seo = [
            'reference_id' => $pages->id,
            'meta_title' => $request->meta_title,
            'reference_type' => 'pages',
            'meta_description'=> $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        $search = seo::create($seo);
        return redirect()->back()->with('success','Pages Created successfully');;


    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Pages::where('id',$id)->get()->first();
        $seo = seo::where('reference_id',$id)->where('reference_type','pages')->get()->first();
        $media = media::where('reference_id', $id)->where('reference_type','pages')->get()->first();
        return view('management/pages/edit',compact('category','seo','media'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $pages = Pages::where('id',$id)->get()->first();
        if($request->file('featured_image')){

            $ext = $request->file('featured_image')->getClientOriginalExtension();
            $main_file = 'pages'.time() . rand(1000, 14000000000) . '.' . $ext;
            $request->featured_image->move(public_path('images/media'), $main_file);
        }
        else
        {
            $main_file = $pages->featured_image;
        }

        $pages->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' =>$request->description,
            'status' => $request->status,
            'featured_image'=> $main_file,
        ]);

        $multi = media::where('reference_id', $id)->where('reference_type','pages')->get()->first();
        if($multi != null ){
            $multi->update([
                'image' => $main_file,
            ]);
        }else {
            $multi_image =
                [
                    'reference_id' => $id,
                    'reference_type' => 'pages',
                    'image' => $main_file,
                ];

            media::create($multi_image);
        }



        $seo = seo::where('reference_id',$pages->id)->get()->first();

        $seo->update([
            'reference_id' => $pages->id,
            'meta_title' => $request->meta_title,
            'reference_type' => 'pages',
            'meta_description'=> $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);


        return redirect()->back()->with('success','Pages Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pages = Pages::where('id',$id)->delete();
        $seos = seo::where('reference_id',$id)->delete();

        return  redirect()->back()->with('success', 'Pages Deleted Succesfully');
    }
}
