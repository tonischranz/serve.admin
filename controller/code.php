<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;
use tsd\serve\Router;
use tsd\serve\ViewEngine;

class CodeController extends AdminControllerBase
{
    #[SecurityGroup("developer")]
    #[MenuItem('code')]
    function showIndex()
    {
        return $this->view();
    }

    #[SecurityGroup("developer")]
    #[MenuItem('controller')]
    function showController()
    {
        $files = [];
        $paths = glob(Router::CONTROLLER . DIRECTORY_SEPARATOR. '*.php');

        foreach ($paths as $p)
        {
            $files[]=['path'=>$p, 'name'=>basename($p)];
        }


        return $this->view(['files' => $files]);
    }

    #[SecurityGroup("developer")]
    function showControllerEdit(string $name)
    {
        $content = file_get_contents(Router::CONTROLLER . DIRECTORY_SEPARATOR.$name);

        return $this->view(['content'=>$content, 'name'=>$name]);
    }

    #[SecurityGroup("developer")]
    function doControllerEdit(string $name, string $content)
    {
        try
        {
            eval('?>' . $content);
            file_put_contents(Router::CONTROLLER . DIRECTORY_SEPARATOR.$name, $content);
            return $this->success('saved');
        }
        catch (\Error $e)
        {
            return $this->view(['content'=>$content, 'name'=>$name]);
        }  
    }

    #[SecurityGroup("developer")]
    #[MenuItem('views')]
    function showViews()
    {        
        return $this->view(['files' => CodeController::readViews()]);
    }

    static function readViews(string $path = ViewEngine::VIEWS)
    {
        foreach (glob($path . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR) as $d) 
            yield ['path'=>$d, 'type'=>'dir', 'name'=>basename($d), 'children' => CodeController::readViews($d)];
               
        foreach (glob($path . DIRECTORY_SEPARATOR . '*.htm?') as $f)
            yield ['path'=>$f, 'type'=>'file', 'name'=>basename($f)];
    }

    #[SecurityGroup("developer")]
    #[MenuItem('src')]
    function showSrc()
    {
        return $this->view();
    }
}