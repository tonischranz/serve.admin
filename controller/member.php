<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;

class MemberController extends Controller
{
    /**
     * @SecurityGroup developer
     */
    function showIndex()
    {
        return $this->view();
    }
}