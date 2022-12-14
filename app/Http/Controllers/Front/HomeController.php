<?php

namespace App\Http\Controllers\Front;

use App\Helpers\LanguageHelper;
use App\Helpers\Recaptcha;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Mail\ContactFormMessage;
use App\Models\Front\Apartment\Apartment;
use App\Models\Front\Catalog\Page;
use App\Models\Front\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->merge(['city' => 'Zagreb']);

        $apartments = Apartment::active()->search($request)->paginate(12);
        $cities     = Apartment::groupBy('city')->pluck('city');

        return view('front.home', compact('apartments', 'cities'));
    }


    /**
     * @param Apartment $apartment
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function apartment(Apartment $apartment)
    {
        $dates = $apartment->dates();
        $langs = LanguageHelper::resolveSelector($apartment);
        $meta  = $apartment->meta();

        return view('front.apartment', compact('apartment', 'dates', 'langs', 'meta'));
    }


    /**
     * @param Apartment $apartment
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function apartmentICS(Apartment $apartment)
    {
        $str = $apartment->ics();
        $path = config('filesystems.disks.ics.root') . $apartment->id . '-calendar.ics';
        $file = file_put_contents($path, $str);

        return response($str)->withHeaders([
            'Content-Type' => 'text/calendar',
            'Content-Disposition' => ' attachment; filename="' . $file . '"',
            'Content-Length' => strlen($str),
            'Connection' => 'close'
        ]);
    }


    /**
     * @param Page $page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function page(Page $page)
    {
        $langs = LanguageHelper::resolveSelector($page, 'info/');

        return view('front.page', compact('page', 'langs'));
    }


    /**
     * @param Faq $faq
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function faq()
    {
        $faqs = Faq::where('status', 1)->orderBy('sort_order')->get();

        return view('front.faq', compact('faqs'));
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contact(Request $request)
    {
        return view('front.contact');
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendContactMessage(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'message' => 'required',
        ]);

        // Recaptcha
        $recaptcha = (new Recaptcha())->check($request->toArray());

        if ( ! $recaptcha->ok()) {
            return back()->withErrors(['error' => 'ReCaptcha Error! Kontaktirajte administratora!']);
        }

        $message = $request->toArray();

        dispatch(function () use ($message) {
            Mail::to(config('mail.admin'))->send(new ContactFormMessage($message));
        });

        return view('front.contact')->with(['success' => 'Va??a poruka je uspje??no poslana.! Odgovoriti ??emo vam uskoro.']);
    }

}
