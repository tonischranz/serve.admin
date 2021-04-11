<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class UpdateController extends Controller
{
    #[SecurityGroup('admin')]
    function showIndex()
    {
        return $this->view();
    }
}