<?php
namespace tsd\serve\admin;

use tsd\serve\Controller;
use tsd\serve\ViewContext;

class AdminControllerBase extends Controller
{
    protected ViewContext $_ctx;

    public function prepare ()
    {
        $this->_ctx->menu[] = [];
    }
   
}