<?php
namespace App\Controller\V1;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller Dedicated to API
 **/

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
    }
}