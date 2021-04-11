<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityUser;

class DefaultController extends Controller
{
    #[SecurityUser]
    function showIndex()
    {
        return $this->view();
    }

    function getMenu()
    {
        
    }
}