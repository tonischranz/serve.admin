<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;

class ConfigController extends Controller
{
    /**
     * @SecurityGroup admin
     */
    function showIndex()
    {
        return $this->view();
    }
}