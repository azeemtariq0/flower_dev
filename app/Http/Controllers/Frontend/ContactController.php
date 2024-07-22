<?php

namespace App\Http\Controllers\Frontend;
use App\Helpers\DefaultLanguage;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Currency;

class ContactController extends Controller
{
    public function index()
    {
        $data['languages'] = DefaultLanguage::AllLanguage();
        $data_languages = DefaultLanguage::SelectedLanguage();
        $language = DefaultLanguage::GetSegment(app()->getLocale());
        $data['currency'] = Currency::where('currency_code', DefaultLanguage::SelectedCurrency())->get()->first();
        return view('Frontend.pages.contact_us',$data);
    }
}
