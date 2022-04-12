<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;
use tsd\serve\App;

class ConfigController extends AdminControllerBase
{
    #[SecurityGroup('admin')]
    #[MenuItem('config')]
    function showIndex()
    {
        $cfg = file_get_contents(App::CONFIG);
        return $this->view(['cfg'=>$cfg]);
    }

    function doIndex(string $cfg)
    {
        $parsed = json_decode($cfg);

        if (!$parsed) return $this->view(['cfg'=>$cfg, 'error'=>true]);

        file_put_contents(App::CONFIG, json_encode($parsed, JSON_PRETTY_PRINT));
        
        return $this->message('successful saved');
    }
}