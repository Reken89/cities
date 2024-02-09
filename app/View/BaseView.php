<?php

namespace App\View;

class BaseView
{
    public function render($page)
    {
        include $_SERVER['DOCUMENT_ROOT']. "/cities". $page;
    }
}

