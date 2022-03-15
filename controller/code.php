<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class CodeController extends AdminControllerBase
{
    #[SecurityGroup("developer")]
    #[MenuItem('code')]
    function showIndex()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    #[MenuItem('controller')]
    function showController()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    #[MenuItem('views')]
    function showViews()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    #[MenuItem('src')]
    function showSrc()
    {
        return $this->view();
    }
}