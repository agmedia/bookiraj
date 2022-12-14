<?php

namespace App\Models\Front\Apartment;

use App\Helpers\CurrencyHelper;
use App\Helpers\Helper;
use App\Helpers\iCal;
use App\Models\Front\Checkout\Order;
use App\Models\Back\Settings\Options\OptionApartment;
use App\Models\Front\Catalog\Action;
use App\Models\Front\Catalog\Option;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Bouncer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class Apartment extends Model implements LocalizedUrlRoutable
{

    /**
     * @var string
     */
    protected $table = 'apartments';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var string[]
     */
    protected $appends = ['title', 'description', 'image', 'thumb', 'price', 'price_text', 'for', 'url'];

    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    protected $main_currency;

    /**
     * @var Request
     */
    protected $request;


    /**
     * Gallery constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->locale = current_locale();
        $this->main_currency = CurrencyHelper::mainSession();
    }


    /**
     * @param $locale
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public function getLocalizedRouteKey($locale)
    {
        return $this->translation($locale)->slug;
    }


    /**
     * @param $value
     * @param $field
     *
     * @return Model|never|null
     */
    public function resolveRouteBinding($value, $field = NULL)
    {
        return static::whereHas('translation', function ($query) use ($value) {
            $query->where('slug', $value);
        })->first() ?? abort(404);
    }


    /**
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ApartmentImage::class, 'apartment_id')->orderBy('sort_order');
    }


    /**
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return ApartmentDetail::getDetailsByApartment($this->id);
    }


    /**
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amenities()
    {
        return ApartmentDetail::getAmenitiesByApartment($this->id);
    }


    /**
     * @param null  $lang
     * @param false $all
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function translation($lang = null, bool $all = false)
    {
        if ($lang) {
            return $this->hasOne(ApartmentTranslation::class, 'apartment_id')->where('lang', $lang)->first();
        }

        if ($all) {
            return $this->hasMany(ApartmentTranslation::class, 'apartment_id');
        }

        return $this->hasOne(ApartmentTranslation::class, 'apartment_id')->where('lang', $this->locale)/*->first()*/;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id', 'id')
                    ->where('status', 1)
                    ->basic();
    }


    /**
     * @return array
     */
    public function options()
    {
        return $this->hasManyThrough(Option::class, OptionApartment::class, 'apartment_id', 'id', 'id', 'option_id')
                        ->where('status', 1);
    }


    /**
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'apartment_id')/*->orderBy('order_id', 'desc')*/;
    }


    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        return $this->translation()->first()->title;
    }


    /**
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->translation()->first()->description;
    }


    /**
     * @return string
     */
    public function getImageAttribute()
    {
        return $this->images()->where('published', 1)->where('default', 1)->first()->image;
    }


    /**
     * @return string
     */
    public function getThumbAttribute()
    {
        return 'test-thumb';
    }


    /**
     * @return string
     */
    public function getPriceAttribute()
    {
        return number_format(($this->resolvePrice() * $this->main_currency->value), $this->main_currency->decimal_places, ',', '.');
    }


    /**
     * @return string
     */
    public function getPriceTextAttribute(): string
    {
        $left = $this->main_currency->symbol_left ? $this->main_currency->symbol_left . ' ' : '';
        $right = $this->main_currency->symbol_right ? ' ' . $this->main_currency->symbol_right : '';

        return $left . number_format(($this->resolvePrice() * $this->main_currency->value), $this->main_currency->decimal_places, ',', '.') . $right;
    }


    /**
     * @return string
     */
    public function getForAttribute()
    {
        return collect(config('settings.apartment_targets'))->where('id', $this->target)->first()['title'][current_locale()];
    }


    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->translation()->first()->url;
    }


    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 1);
    }


    /**
     * @param Builder $query
     * @param Request $request
     *
     * @return Builder
     */
    public function scopeSearch(Builder $query, Request $request): Builder
    {
        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }
        if ($request->has('adults')) {
            $query->where('adults', '>=', $request->input('adults'));
        }
        if ($request->has('children')) {
            $query->where('children', '>=', $request->input('children'));
        }

        if ($request->has('from') || $request->has('to')) {
            $query->whereHas('orders', function ($query) use ($request) {
                /*$query->where(function ($query) use ($request) {
                    $query->where('date_from', '<=', date($request->input('from')))->where('date_to', '>=', date($request->input('to')));
                });*/
                $query->orWhere(function ($query) use ($request) {
                    $query->where('date_from', '<', date($request->input('from')))->where('date_to', '>=', date($request->input('to')));
                });
                $query->orWhere(function ($query) use ($request) {
                    $query->where('date_from', '>=', date($request->input('from')))->where('date_to', '<', date($request->input('to')));
                });
            });
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            if ($sort == 'new') {
                $query->orderBy('created_at', 'desc');
            }
            if ($sort == 'old') {
                $query->orderBy('created_at');
            }
            if ($sort == 'top') {
                $query->orderBy('featured');
            }
            if ($sort == 'popular') {
                $query->orderBy('viewed');
            }
        }

        return $query;
    }


    /**
     * @return array
     */
    public function dates()
    {
        $response = [];
        $orders = Order::active()->where('apartment_id', $this->id)->where('date_to', '>', now())->get();

        foreach ($orders as $order) {
            $response[] = [Carbon::make($order->date_from)->format('Y-m-d'), Carbon::make($order->date_to)->format('Y-m-d')];
        }

        return $response;
    }


    /**
     * @return mixed
     */
    public function getPriceByDay()
    {
        $now = now();

        if ($now->isFriday() || $now->isSaturday()) {
            return $this->price_weekends;
        }

        return $this->price_regular;
    }


    /**
     * @return float|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function resolvePrice()
    {
        $price = $this->getPriceByDay();

        $action = $this->action()->first();

        if ($action) {
            if ($action->type == 'P') {
                if ($action->discount > 0) {
                    $price = Helper::calculateDiscountPrice($price, number_format($action->discount));
                }
                if ($action->extra > 0) {
                    $price = Helper::calculateDiscountPrice($price, number_format($action->extra), true);
                }
            }

            if ($action->type == 'F') {
                $price = ($action->discount > 0) ? $action->discount : $action->extra;
            }
        }

        return $price;
    }


    /**
     * @return array
     */
    public function meta()
    {
        return [
            'type' => 'apartment',
            'title' => config('app.name') . ' - ' . $this->title,
            'description' => substr($this->description, 0, 100) . '...',
            'image' => $this->image,
            'image_height' => 800,
            'image_width' => 1440,
            'image_type' => 'image/webp',
            'image_alt' => $this->title
        ];
    }


    /**
     * @return string
     */
    public function ics(): string
    {
        $orders = Order::query()
                       ->where('apartment_id', $this->id)
                       ->where('created_at', '>', now()->subMonths(3))
                       ->whereIn('order_status_id', Helper::getValidOrderStatuses())
                       ->select('id', 'order_status_id', 'date_from', 'date_to', 'sync_uid', 'created_at')
                       ->get();

        $events = [];

        foreach ($orders as $order) {
            $events[] = [
                'uid' => $order->sync_uid,
                'from' => $order->date_from,
                'to' => $order->date_to,
            ];
        }

        $ical = new iCal();

        if (count($events)) {
            return $ical->createFrom($events);
        }

        return $ical->returnEmpty();
    }


}
