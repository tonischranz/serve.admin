<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class ConfigController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[MenuItem('config')]
    function showIndex()
    {
        return $this->view();
    }
}