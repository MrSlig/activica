<?php

require_once 'BaseController.php';
use Activica\YMLParser\Offer\Offer;

class DefaultController extends BaseController
{

    public function indexAction()
    {
        getGoods(__DIR__.'/../../data/XML/goods.xml');

        $stmt = DB::getInstance()->getPDO()
            ->prepare(' '
                . 'SELECT * '
                . 'FROM shop_offers '   //todo FIX table
                . 'LIMIT 40');
        $stmt->execute();
        $offers = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $offer = new Offer();
            $offer->setId($row['id']);
            $offer->setAvailable($row['available']);
            $offer->setUrl($row['url']);
            $offer->setPrice($row['price']);
            $offer->setOptPrice($row['opt_price']);
            $offer->setCategoryId($row['category_id']);
            $offer->setPictures($row['picture']);
            $offer->setName($row['name']);
            $offer->setArticul($row['articul']);
            $offer->setVendor($row['vendor']);
            $offer->setDescription($row['description']);
            $offer->setSeason($row['season']);
            $offer->setModel($row['model']);
            $offer->setNew($row['new']);
            $offer->setAction($row['action']);
            $offer->setTop($row['top']);
            $offers[] = $offer;
        }
        return self::render('index', $offers);
    }

    public
    function vendorAction()
    {

    }

    public
    function parserAction()
    {

    }
}
    /*
        public function categoriesAction() {
            $data['categories'] = [
                [
                    'id' => 1,
                    'name' => 'Интструменты',

                ],
                [
                    'id' => 2,
                    'name' => 'Одежда',
                ],
            ];
            $data['categoriesCount'] = 18;
            return render('categories', $data);
        }

        public function jqueryAction() {
            return render("jQuery");
        }

        public function ajaxAction() {
            $posts = [
                [
                    'title' => 'Заголовок a1',
                    'text' => 'Текст a1',
                ],
                [
                    'title' => 'Заголовок a2',
                    'text' => 'Текст a2',
                ],
                [
                    'title' => 'Заголовок a3',
                    'text' => 'Текст a3',
                ],
                [
                    'title' => 'Заголовок a4',
                    'text' => 'Текст a4',
                ],
                [
                    'title' => 'Заголовок a5',
                    'text' => 'Текст a5',
                ],
            ];
            return $posts;
        }
        */

    /*
     * fail case: made class instead array:
     *
     * $offer = new Offer();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $offer->setId($row['id']);
            $offer->setAvailable($row['available']);
            $offer->setUrl($row['url']);
            $offer->setPrice($row['price']);
            $offer->setOptPrice($row['opt_price']);
            $offer->setCategoryId($row['categoryId']);
            $offer->setPictures($row['picture']);
            $offer->setName($row['name']);
            $offer->setArticul($row['articul']);
            $offer->setVendor($row['vendor']);
            $offer->setDescription($row['description']);
            $offer->setSeason($row['season']);
            $offer->setModel($row['model']);
            $offer->setNew($row['new']);
            $offer->setAction($row['action']);
            $offer->setTop($row['top']);
        }
     *
     *
     *
     *         $offer=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $offer[]=[
                'id' => $row['id'],
                'available' => $row['available'],
                'url' => $row['url'],
                'price' => $row['price'],
                'opt_price' => $row['opt_price'],
                'categoryId' => $row['category_id'],
                'picture' => $row['picture'],
                'name' => $row['name'],
                'articul' => $row['articul'],
                'description' => $row['description'],
                'season' => $row['season'],
                'model' => $row['model'],
                'new' => $row['new'],
                'action' => $row['action'],
                'top' => $row['top'],
            ];
     */
