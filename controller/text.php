<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class TextController extends Controller
{
    #[SecurityGroup('admin')]
    #[SecurityGroup('editor')]
    #[SecurityGroup('developer')]
    function showIndex()
    {
        return $this->view();
    }
}