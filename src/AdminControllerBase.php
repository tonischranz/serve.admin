<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\ViewContext;

class AdminControllerBase extends Controller
{
    protected ViewContext $_ctx;

    public function prepare ()
    {
        $this->_ctx->menu['admin'] = [
            ['url' => 'code', 'name' => 'code', 'children' => [
                ['url' => 'code/controller', 'name' => 'controller'],
                ['url' => 'code/src', 'name' => 'src'],
                ['url' => 'code/views', 'name' => 'views']
            ]],
            ['url' => 'config', 'name' => 'config'],
            ['url' => 'plugins', 'name' => 'plugins'],
            ['url' => 'ipsum', 'name' => 'ipsum']
        ];
    }
   
}