<?php
namespace App\Controller;

class PostsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * function index
     * all method
     * http://localhost/api/posts/index.json
     */
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

    /**
     * function view
     * all method
     * can use get method while add allowMethod
     * http://localhost/api/posts/view/($id).json
     */
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

    /**
     * function add
     * POST| PUT
     * http://localhost/api/posts/add.json
     */
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

    /**
     * function edit
     * POST| PUT
     * http://localhost/api/posts/edit.json
     */
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

    /**
     * function delete
     * DELETE
     * http://localhost/api/posts/delete/($id).json
     */
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