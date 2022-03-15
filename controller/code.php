<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;

class CodeController extends AdminControllerBase
{
    #[SecurityGroup("developer")]
    function showIndex()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    function showController()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    function showViews()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    function showSrc()
    {
        return $this->view();
    }
}