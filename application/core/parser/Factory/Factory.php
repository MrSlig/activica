<?php

namespace Activica\YMLParser\Factory;

use Activica\YMLParser\Category;
use Activica\YMLParser\Currency;
use Activica\YMLParser\Offer\BookOffer;
use Activica\YMLParser\Offer\Offer;
use Activica\YMLParser\Offer\VendorModelOffer;
use Activica\YMLParser\Param;
use Activica\YMLParser\Shop;

class Factory
{
    public function createParam()
    {
        return new Param();
    }
    public function createShop()
    {
        return new Shop();
    }

    public function createCategory()
    {
        return new Category();
    }

    public function createCurrency()
    {
        return new Currency();
    }

    public function createOffer($type)
    {
        switch ($type) {
            case 'vendor.model':
                return new VendorModelOffer();
            case 'book':
                return new BookOffer();
            default:
                return new Offer();
        }
    }
}
