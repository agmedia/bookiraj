<?php

namespace App\Models\Front\Catalog;

use App\Models\Back\Settings\System\PageTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var string
     */
    protected $locale = 'en';


    /**
     * Gallery constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->locale = current_locale();
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
            return $this->hasOne(PageTranslation::class, 'page_id')->where('lang', $lang)->first();
        }

        if ($all) {
            return $this->hasMany(PageTranslation::class, 'page_id');
        }

        return $this->hasOne(PageTranslation::class, 'page_id')->where('lang', $this->locale)/*->first()*/;
    }


    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeSubgroups(Builder $query): Builder
    {
        return $query->groupBy('subgroup')->whereNotNull('subgroup');
    }


    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeGroups(Builder $query): Builder
    {
        return $query->groupBy('group')->whereNotNull('group');
    }
}