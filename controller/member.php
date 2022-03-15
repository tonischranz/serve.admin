<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;

class MemberController extends AdminControllerBase
{
    #[SecurityGroup('developer')]
    #[MenuItem('member')]
    function showIndex()
    {
        return $this->view();
    }
}