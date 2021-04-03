<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;

class CodeController extends Controller
{
    /**
     * @SecurityGroup developer
     */
    function showIndex()
    {
        return $this->view();
    }
}