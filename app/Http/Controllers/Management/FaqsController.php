<?php

namespace App\Http\Controllers\Management;
use App\Http\Controllers\Controller;
use App\Helpers\DefaultLanguage;
use App\Models\faqs;
use App\Models\faqs_details;

use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faqs'] = faqs::latest()->get();
        return view('management.faqs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = DefaultLanguage::SelectedLanguage();
        return view('management.faqs.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'status' => $request->status,
            'faqs_reference' => $request->faqs_reference,
        ];
        $query = faqs::create($data);
        $faq_id = $query->id;
        $var = $request['faqs_question'];
        $i = 0;
        foreach ($var as $faqs) {
            $a = $request->faqs_answer;
            faqs_details::create([
                'faqs_id' => $faq_id,
                'title' => $request->title,
                'language_id' => $request->language_id,
                'faqs_question' => $faqs,
                'faqs_answer' => $request->faqs_answer[$i],
            ]);
            $i++;
        }
        return redirect()->route('faqs.show', $query->id)->with('success', 'Faqs Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Holidays $holidays
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['language'] = DefaultLanguage::SelectedLanguage();
        $data['faqs'] = faqs::where('id', $id)->get()->first();
        $data['faqs_details'] = faqs_details::where('faqs_id', $id)->where('language_id',$data['language']->id)->get();
        return view('management.faqs.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Holidays $holidays
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Holidays $holidays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faqs = faqs::where('id', $id)->get()->first();
        $faqs_details = faqs_details::where('faqs_id', $id)->delete();
        $query = $faqs->update([
            'title' => $request->title,
            'status' => $request->status,
            'faqs_reference' => $request->faqs_reference,
        ]);
        $var = $request['faqs_question'];
        $i = 0;
        foreach ($var as $faqs) {
            $a = $request->faqs_answer;
            faqs_details::create([
                'faqs_id' => $id,
                'title' => $request->title,
                'language_id' => $request->language_id,
                'faqs_question' => $faqs,
                'faqs_answer' => $request->faqs_answer[$i],
            ]);
            $i++;
        }
        return redirect()->back()->with('success', "FAQs Updated SUccessfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Holidays $holidays
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faqs = faqs::where('id', $id)->delete();
        return redirect()->back()->with('success', "FAQ Deleted Successfully");
    }
}
