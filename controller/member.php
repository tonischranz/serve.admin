<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class MemberController extends Controller
{
    #[SecurityGroup('developer')]
    function showIndex()
    {
        return $this->view();
    }
}