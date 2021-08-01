<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\SecurityGroup;

class LabelsController extends Controller
{
    #[SecurityGroup('admin')]
    #[SecurityGroup('editor')]
    #[SecurityGroup('developer')]
    function showIndex()
    {
        return $this->view();
    }
}