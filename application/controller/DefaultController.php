<?php

// LEGASY

class DefaultController {
    public function indexAction() {
        $stmt = DB::getInstance()->getPDO()
            ->prepare('SELECT * FROM shop_offers');
        $stmt->execute();
        $data['name'] = $stmt->fetchAll();
        return render ('index', $data);
    }
    public function vendorAction() {
        require_once __DIR__ . '/../model/Post.php';
        $data['post'] = Post::getPost(DB::getInstance(), $_GET['id']);
        return render('post', $data);
    }
    public function parserAction() {
        require_once __DIR__ . '/../model/Post.php';
        $data['post'] = Post::getPost(DB::getInstance(), $_GET['id']);
        return render('post', $data);
    }
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
}