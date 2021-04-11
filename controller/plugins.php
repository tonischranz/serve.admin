<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class PluginsController extends Controller
{
    #[SecurityGroup('admin')]
    function showIndex()
    {
        return $this->view();
    }
}