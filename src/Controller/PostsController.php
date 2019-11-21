<?php
namespace App\Controller;

class PostsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $posts = $this->Posts->find('all');
        $this->set([
            'posts' => $posts,
            '_serialize' => [
                'posts'
            ]
        ]);
    }

    public function view($id = null)
    {
        $posts = $this->Posts->get($id);
        $this->set([
            'post' => $posts,
            '_serialize' => [
                'post'
            ]
        ]);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $post = $this->Posts->newEntity($this->request->getData());
        if ($this->Posts->save($post)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'post' => $post,
            '_serialize' => ['message', 'post']
        ]);
    }

    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $post = $this->Posts->get($id);
        $post = $this->Posts->patchEntity($post, $this->request->getData());
        if ($this->Posts->save($post)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $userId = $this->Posts->get($id);
        $message = 'Deleted';
        if (!$this->Posts->delete($userId)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}