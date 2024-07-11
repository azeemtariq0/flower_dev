<?php

namespace App\Http\Controllers\Management;

use App\Helpers\DefaultLanguage;
use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Contact;
use App\Models\EnquireNow;
use App\Models\media;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::latest()->get()->all();
        return view('management/contact/index', compact('data'));
    }

    public function subscriber()
    {
        $data = Newsletter::latest()->get()->all();
        return view('management/contact/newsletter', compact('data'));
    }

    public function allEnquire()
    {
        $data = EnquireNow::Leftjoin('packages', 'packages.id', '=', 'enquire_nows.package_id')
            ->select('packages.id AS pack_id', 'packages.title', 'enquire_nows.*')->orderBy('enquire_nows.created_at', 'desc')->get();
        return view('management/enquire/index', compact('data'));
    }

    public function getEnquire($id)
    {
        $data = EnquireNow::Leftjoin('packages', 'packages.id', '=', 'enquire_nows.package_id')
            ->where('enquire_nows.id', $id)
            ->select('packages.title', 'enquire_nows.*')->get()->first();
        return view('management/enquire/show', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\country $country
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\country $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Contact::where('id', $id)->get()->first();
        return view('management/contact/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\country $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function show_contact()
    {
        return view('Frontend.contact.index');
    }

    public function contact_stored(Request $request)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        $query = Contact::create($data);
        if ($query) {
            return redirect()->back()->with('success', 'Contact Form Submitted Succesfully');
        } else {
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Contact Deleted Succesfully');
    }

    public function imageDelete(Request $request)
    {
        $categories = media::where('id', $request->id)->delete();
        return true;
    }
}
