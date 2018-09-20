<?php

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
        . 'available bit, '
        . 'url varchar(50), '
        . 'price int(7), '
        . 'opt_price int(7), '
        . 'category_id int(4), '
        . 'picture varchar(50), '
        . 'name varchar(50), '
        . 'articul varchar(50), '
        . 'vendor varchar(50), '
        . 'description varchar(50), '
        . 'season varchar(50), '
        . 'model varchar(50), '
        . 'new bit, '
        . 'action bit, '
        . 'top bit);'
    );
    $stmt->execute();

    foreach ($result->getOffers() as $offer) {
        $stmt   = DB::getInstance()->getPDO()->prepare(' '
            . 'INSERT INTO '
            . $shop->getName()
            . '_offers '
            . '(available,'
            . 'url, '
            . 'price, '
            . 'opt_price, '
            . 'category_id, '
            . 'picture, '
            . 'name, '
            . 'articul, '
            . 'vendor, '
            . 'description, '
            . 'season, '
            . 'model, '
            . 'new, '
            . 'action, '
            . 'top) '
            . 'VALUES '
            . '(:available, '
            . ':url, '
            . ':price, '
            . ':opt_price, '
            . ':category_id, '
            . ':picture, '
            . ':name, '
            . ':articul, '
            . ':vendor, '
            . ':description, '
            . ':season, '
            . ':model, '
            . ':new, '
            . ':action, '
            . ':top);'
        );
        $stmt->bindValue(':available',$offer->isAvailable(), PDO::PARAM_BOOL);
        $stmt->bindValue(':url', $offer->getUrl(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $offer->getPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':opt_price', $offer->getOptPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $offer->getCategoryId(), PDO::PARAM_INT);
        $stmt->bindValue(':picture', $offer->getPictures()[0], PDO::PARAM_STR);
        $stmt->bindValue(':name', $offer->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':articul', $offer->getArticul(), PDO::PARAM_STR);
        $stmt->bindValue(':vendor', $offer->getVendor(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $a = iconv('cp1251//IGNORE', 'utf-8//IGNORE',
            (string)$offer->getDescription()), PDO::PARAM_STR); //NOT WORKING CORRECTLY
        $stmt->bindValue(':season', $offer->getSeason(), PDO::PARAM_STR);
        $stmt->bindValue(':model', $offer->getModel(), PDO::PARAM_STR);
        $stmt->bindValue(':new', $offer->isNew(), PDO::PARAM_BOOL);
        $stmt->bindValue(':action', $offer->isAction(), PDO::PARAM_BOOL);
        $stmt->bindValue(':top', $offer->isTop(), PDO::PARAM_BOOL);
        $stmt->execute();

        //-------------IT'S NOT WORKING TOO:-----------------------------
        // iconv('windows-1251', 'UTF-8', (string)$offer->getDescription())
        // mb_convert_encoding((string)$offer->getDescription(), "UTF-8", "windows-1251")
        // $text = iconv('cp1251//IGNORE', 'utf-8//IGNORE', $text);
    }
    return $shop->getCategories();
}