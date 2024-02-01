<?php

namespace App\Controllers;

use App\View\BaseView;

class BaseController 
{
    public $view;
    
    public function __construct() 
    {
        $this->view = new BaseView();
    }
    
}

