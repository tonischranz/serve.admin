<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;

class TextController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[SecurityGroup('editor')]
    #[SecurityGroup('developer')]
    function showIndex()
    {
        return $this->view();
    }
}