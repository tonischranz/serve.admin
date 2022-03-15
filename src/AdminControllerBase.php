<?php
namespace tsd\serve\admin;

use tsd\serve\App;
use tsd\serve\Controller;
use tsd\serve\Router;
use tsd\serve\ViewContext;
use \ReflectionClass;

class AdminControllerBase extends Controller
{
    protected ViewContext $_ctx;

    public function prepare ()
    {
        $menu = [];
        $controllers = glob(App::PLUGINS . DIRECTORY_SEPARATOR . $this->_ctx->layoutPlugin . DIRECTORY_SEPARATOR . Router::CONTROLLER . DIRECTORY_SEPARATOR . '*.php');
        foreach($controllers as $cp)
        {
            $name = basename($cp, '.php');

            /*if ($name == 'default') continue;*/

            include_once $cp;
            $refClass = new ReflectionClass("tsd\\serve\\admin\\${name}Controller");
            $indexMethod = $refClass->getMethod('showIndex');

            if ($indexMethod)
            {
                $miAttrs = $indexMethod->getAttributes('tsd\serve\MenuItem');
                $secUserAttr = $indexMethod->getAttributes('tsd\serve\SecurityUser');
                $secGroupAttrs = $indexMethod->getAttributes('tsd\serve\SecurityGroup');

                if (!$miAttrs) continue;

                $miAtt = $miAttrs[0]->newInstance();

                if($secUserAttr && $this->_member->isAnonymous()) continue;
                if($secGroupAttrs)
                {
                    $ok = false;

                    foreach($secGroupAttrs as $sga)
                    {
                        $sgAtt = $sga->newInstance();
                        if ($this->_member->isInGroup($sgAtt->name))
                        {
                            $ok = true;
                            break;
                        }
                    }

                    if (!$ok) continue;
                }

                $mi = ['url' => $name, 'name' => $miAtt->name];

                //todo: other MenuItems (children)

                $menu[] = $mi;
            }             
        }

        $this->_ctx->menu['admin'] = $menu; /*[
            ['url' => 'code', 'name' => 'code', 'children' => [
                ['url' => 'code/controller', 'name' => 'controller'],
                ['url' => 'code/src', 'name' => 'src'],
                ['url' => 'code/views', 'name' => 'views'],
                ['url' => 'code/foo', 'name' => 'foo']
            ]],
            ['url' => 'config', 'name' => 'config'],
            ['url' => 'plugins', 'name' => 'plugins'],
            ['url' => 'ipsum', 'name' => 'ipsum']
        ];*/
    }
   
}