<?php
/**
 * Created by PhpStorm.
 * User: sligx
 * Date: 9/19/2018
 * Time: 12:01 PM
 */

use Activica\YMLParser\Parser;

function getGoods($file) {

    $goods = [];
    $parser = new Parser();
    $result = $parser->parse($file);

    $shop = $result->getShop();
    $goods['shop'] = $shop;

    $stmt   = DB::getInstance()->getPDO()->prepare(' '
        . 'CREATE TABLE IF NOT EXISTS '
        . $shop->getName()
        . '_categories '
        . '(id int NOT NULL PRIMARY KEY auto_increment, '
        . 'category int(4), '
        . 'parent int(4), '
        . 'name varchar(50));'
        );
    $stmt->execute();

    //todo FIX MULTIPLE ENTRY
    foreach ($shop->getCategories() as $category) {
        $stmt   = DB::getInstance()->getPDO()->prepare(' '
            . 'INSERT INTO '
            . $shop->getName()
            . '_categories '
            . '(category, parent, name) '
            . 'VALUES(:category, :parent, :name);'
        );
        $stmt->bindValue(':category', $category->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':parent',
            $category->getParent() ? $category->getParent()->getId() : 0, PDO::PARAM_INT);
        $stmt->bindValue(':name', mb_convert_encoding((string)$category->getName(),
            "UTF-8", "windows-1251"), PDO::PARAM_STR);
        $stmt->execute();
    }

    $stmt   = DB::getInstance()->getPDO()->prepare(' '
        . 'CREATE TABLE IF NOT EXISTS '
        . $shop->getName()
        . '_offers '
        . '(id int NOT NULL PRIMARY KEY auto_increment, '
        . 'offer_id int(4), '
        . 'available bit, '
        . 'url varchar(50), '
        . 'price int(7), '
        . 'opt_price int(7), '
        . 'category_id int(4), '
        . 'picture varchar(50), '
        . 'name varchar(50), '
        . 'articul int(7), '
        . 'vendor varchar(50), '
        . 'description varchar(50), '
        . 'season varchar(50), '
        . 'ext_name varchar(50), '
        . 'status_new bit, '
        . 'status_action bit, '
        . 'status_top bit);'
    );
    $stmt->execute();

    foreach ($result->getOffers() as $offer) {
        $stmt   = DB::getInstance()->getPDO()->prepare(' '
            . 'INSERT INTO '
            . $shop->getName()
            . '_offers '
            . '(offer_id,
                 available,
                 url,
                 price,
                 opt_price,
                 category_id,
                 picture,
                 name,
                 articul,
                 vendor,
                 description,
                 season,
                 ext_name,
                 status_new,
                 status_action,
                 status_top) '
            . 'VALUES(:offer_id,
                 :available,
                 :url,
                 :price,
                 :opt_price,
                 :category_id,
                 :picture,
                 :name,
                 :articul,
                 :vendor,
                 :description,
                 :season,
                 :ext_name,
                 :status_new,
                 :status_action,
                 :status_top);'
        );
        $stmt->bindValue(':offer_id', $offer->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':available',$offer->isAvailable(), PDO::PARAM_INT);
        $stmt->bindValue(':url', $offer->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $offer->getPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':opt_price', 999, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', 999, PDO::PARAM_INT);
        $stmt->bindValue(':picture', $offer->getPictures()[0], PDO::PARAM_STR);
        $stmt->bindValue(':name', $offer->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':articul', 999, PDO::PARAM_INT);
        $stmt->bindValue(':vendor', 'VENDOR', PDO::PARAM_STR);
        $stmt->bindValue(':description', mb_convert_encoding((string)$offer->getDescription(),
            "UTF-8", "windows-1251"), PDO::PARAM_STR);
        $stmt->bindValue(':season', 'SEASON', PDO::PARAM_STR);
        $stmt->bindValue(':ext_name', $offer->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':status_new', 0, PDO::PARAM_INT);
        $stmt->bindValue(':status_action', 0, PDO::PARAM_INT);
        $stmt->bindValue(':status_top', 0, PDO::PARAM_INT);
        $stmt->execute();
    }
    return $shop->getCategories();
}