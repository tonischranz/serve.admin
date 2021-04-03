<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;

class DefaultController extends Controller
{
    /**
     * @SecurityUser
     */
    function showIndex()
    {
        return $this->view();
    }

    function getMenu()
    {
        
    }
}