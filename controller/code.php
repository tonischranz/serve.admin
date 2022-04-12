<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;
use tsd\serve\Router;
use tsd\serve\ViewEngine;
use tsd\serve\Factory;

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
    function showControllerEdit(array $path)
    {
        $ext = array_pop($path);
        $name = array_pop($path);

        $content = file_get_contents(Router::CONTROLLER . DIRECTORY_SEPARATOR."$name.$ext");

        return $this->view(['content'=>$content, 'name'=>"$name.$ext"]);
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
        $len = strlen(ViewEngine::VIEWS) + 1;

        foreach (glob($path . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR) as $d) 
            yield ['path'=>str_replace(DIRECTORY_SEPARATOR, '/', substr($d, $len)), 'type'=>'dir', 'name'=>basename($d), 'children' => CodeController::readViews($d)];
               
        foreach (glob($path . DIRECTORY_SEPARATOR . '*.htm?') as $f)
            yield ['path'=>str_replace(DIRECTORY_SEPARATOR, '/', substr($f, $len)), 'type'=>'file', 'name'=>basename($f)];
    }

    #[SecurityGroup("developer")]
    function showViewsEdit(array $path)
    {
        $ext = array_pop($path);
        $name = array_pop($path);

        $filePath = implode(DIRECTORY_SEPARATOR, $path).DIRECTORY_SEPARATOR.$name.'.'.$ext;

        $content = file_get_contents(ViewEngine::VIEWS. DIRECTORY_SEPARATOR.$filePath);


        return $this->view(['content' => $content, 'name' => "$name.$ext"]);
    }

    #[SecurityGroup("developer")]
    #[MenuItem('src')]
    function showSrc()
    {
        $files = [];
        $paths = glob(Factory::SRC . DIRECTORY_SEPARATOR. '*.php');

        foreach ($paths as $p)
        {
            $files[]=['path'=>$p, 'name'=>basename($p)];
        }


        return $this->view(['files' => $files]);
    }

    #[SecurityGroup("developer")]
    function showSrcEdit(array $path)
    {
        $ext = array_pop($path);
        $name = array_pop($path);

        $content = file_get_contents(Factory::SRC . DIRECTORY_SEPARATOR."$name.$ext");

        return $this->view(['content'=>$content, 'name'=>"$name.$ext"]);
    }
}