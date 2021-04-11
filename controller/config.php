<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;


class ConfigController extends Controller
{
    #[SecurityGroup('admin')]
    function showIndex()
    {
        return $this->view();
    }
}