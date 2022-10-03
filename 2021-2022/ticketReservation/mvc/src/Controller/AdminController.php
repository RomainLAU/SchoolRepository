<?php

namespace Mvc\Controller;

use Framework\Controller;
use Mvc\Model\AdminModel;
use Twig\Environment;

class AdminController extends Controller
{
    private AdminModel $adminModel;

    public function __construct() {
        parent::__construct();
        $this->adminModel = new AdminModel();
    }

    public function listEvent()
    {
        $events = $this->adminModel->getEvents();

        if (isset($events))
        {
            echo $this->twig->render('admin/events.html.twig', [
                'events' => $events,
            ]);
        }
    }
}