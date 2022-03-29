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
        $files = [];

        
        //$files = \glob(ViewEngine::VIEWS . DIRECTORY_SEPARATOR . '**');
        /*$sd = scandir(ViewEngine::VIEWS);

        foreach ($sd as $d)
        {
            if ($d == '.' || $d == '..') continue;
            if (\is_dir($d))
            {
                $sd2 = scandir(ViewEngine::VIEWS);
                foreach ($sd2 as $d2)
                {
                    if ($d2 == '.' || $d2 == '..') continue;
                    if (\is_dir($d2))
                    {
                        $sd3 = scandir(ViewEngine::VIEWS);
                        foreach ($sd3 as $d3)
                        {
                            if ($d3 == '.' || $d3 == '..') continue;
          
                            $files[] = ['path'=>$d3, 'name'=>$d3];
                        }
                    }
                    else
                    {
                        $files[] = ['path'=>$d2, 'name'=>$d2];
                    }
                }
            }
            else
            {
                $files[] = ['path'=>$d, 'name'=>$d];
            }
        }
        //$paths = glob(ViewEngine::VIEWS . DIRECTORY_SEPARATOR. '*');// . DIRECTORY_SEPARATOR .'*.html');


        /*foreach ($paths as $p)
        {
            $files[]=['path'=>$p, 'name'=>basename($p)];
        }*/

        return $this->view(['files' => $files]);
    }

    #[SecurityGroup("developer")]
    #[MenuItem('src')]
    function showSrc()
    {
        return $this->view();
    }
}