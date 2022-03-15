<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;

class PluginsController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    function showIndex()
    {
        return $this->view();
    }
}