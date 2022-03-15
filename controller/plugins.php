<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class PluginsController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[MenuItem('plugins')]
    function showIndex()
    {
        return $this->view();
    }
}