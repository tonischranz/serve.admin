<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class TextController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[SecurityGroup('editor')]
    #[SecurityGroup('developer')]
    #[MenuItem('text')]
    function showIndex()
    {
        return $this->view();
    }
}