<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityUser;

class DefaultController extends AdminControllerBase
{
    #[SecurityUser]
    function showIndex()
    {
        return $this->view();
    }
}