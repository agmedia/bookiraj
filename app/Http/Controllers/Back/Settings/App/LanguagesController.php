<?php

namespace App\Http\Controllers\Back\Settings\App;

use App\Http\Controllers\Controller;
use App\Models\Back\Settings\Faq;
use App\Models\Back\Settings\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info(App::getLocale());
        App::setLocale('en');
        Log::info(App::getLocale());

        $items = Settings::get('language', 'list')->sortBy('sort_order');
        $main = $items->where('main', 1)->first();

        return view('back.settings.app.languages', compact('items', 'main'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;

        $setting = Settings::where('code', 'language')->where('key', 'list')->first();

        $values = collect();

        if ($setting) {
            $values = collect(json_decode($setting->value));
        }

        if ( ! $data['id']) {
            $data['id'] = $values->count() + 1;
            $values->push($data);
        }
        else {
            $values->where('id', $data['id'])->map(function ($item) use ($data) {
                $item->title = $data['title'];
                $item->code = $data['code'];
                $item->symbol_left = $data['symbol_left'];
                $item->symbol_right = $data['symbol_right'];
                $item->value = $data['value'];
                $item->decimal_places = $data['decimal_places'];
                $item->status = $data['status'];
                $item->main = $data['main'];

                return $item;
            });
        }

        if ( ! $setting) {
            $stored = Settings::insert('language', 'list', $values->toJson(), true);
        } else {
            $stored = Settings::edit($setting->id, 'currency', 'list', $values->toJson(), true);
        }

        if ($stored) {
            return response()->json(['success' => 'Jezik je uspješno snimljen.']);
        }

        return response()->json(['message' => 'Server error! Pokušajte ponovo ili kontaktirajte administratora!']);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMain(Request $request)
    {
        $data = $request->data;

        $setting = Settings::where('code', 'language')->where('key', 'list')->first();

        $values = collect();

        if ($setting) {
            $values = collect(json_decode($setting->value));
        }

        if (isset($data['main'])) {
            $values->where('id', intval($data['main']))->map(function ($item) use ($data) {
                $item->main = true;

                return $item;
            });

            $values->where('id', '!=', intval($data['main']))->map(function ($item) use ($data) {
                $item->main = false;

                return $item;
            });
        }

        $stored = Settings::edit($setting->id, 'language', 'list', $values->toJson(), true);

        if ($stored) {
            return response()->json(['success' => 'Jezik je uspješno snimljen.']);
        }

        return response()->json(['message' => 'Server error! Pokušajte ponovo ili kontaktirajte administratora!']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->data;

        if ($data['id']) {
            $setting = Settings::where('code', 'language')->where('key', 'list')->first();

            $values = collect(json_decode($setting->value));

            $new_values = $values->reject(function ($item) use ($data) {
                return $item->id == $data['id'];
            });

            $stored = Settings::edit($setting->id, 'language', 'list', $new_values->toJson(), true);
        }

        if ($stored) {
            return response()->json(['success' => 'Jezik je uspješno obrisan.']);
        }

        return response()->json(['message' => 'Server error! Pokušajte ponovo ili kontaktirajte administratora!']);
    }
}
