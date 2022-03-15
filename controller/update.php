<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class UpdateController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[MenuItem('update')]
    function showIndex()
    {
        return $this->view();
    }
}