<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class CodeController extends Controller
{
    #[SecurityGroup("developer")]
    function showIndex()
    {
        return $this->view();
    }
}