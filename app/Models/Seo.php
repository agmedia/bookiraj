<?php

namespace App\Models;

use App\Models\Front\Catalog\Author;
use App\Models\Front\Catalog\Product;
use App\Models\Front\Catalog\Publisher;

/**
 * Class Sitemap
 * @package App\Models
 */
class Seo
{


    /**
     * @return array
     */
    public static function getProductData(Product $product): array
    {
        return [
            'title'       => $product->name . ' knjige ' . (isset($product->author->title) ? $product->author->title : ''),
            'description' => 'Knjiga ' . $product->name . ' izdavača ' . (isset($product->author->title) ? $product->author->title : '') . ' godine izdanja ' . ($product->year ?: '') . ' i mjesta izdavanja ' . ($product->origin ?: '') . ' u Antikvarijatu Biblos.'
        ];
    }


    /**
     * @return array
     */
    public static function getAuthorData(Author $author): array
    {
        return [
            'title'       => $author->title . ' knjige - Antikvarijat Biblos',
            'description' => 'Knjige autora ' . $author->title . ' danas su jako popularne u svijetu. Bogati izbor knjiga autora ' . $author->title . ' uz brzu dostavu i sigurnu kupovinu.'
        ];
    }


    /**
     * @return array
     */
    public static function getPublisherData(Publisher $publisher): array
    {
        return [
            'title'       => $publisher->title . ' knjige - Antikvarijat Biblos',
            'description' => 'Ponuda knjiga nakladnika ' . $publisher->title . '. Knjige iz antikvarijata, naklade ' . $publisher->title . ' mogu biti u vašem domu uz brzu dostavu.'
        ];
    }


}
