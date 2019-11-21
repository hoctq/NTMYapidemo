<?php
namespace App\Controller\V1;

use App\Controller\V1\AppController;

class PostsController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index(){
        $posts = $this->Posts>find('all');
        $this->set([
            'posts' => $posts,
            '_serialize' => [
                'posts'
            ]
        ]);
    }
}