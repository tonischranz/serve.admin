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
        $pmenu = [];
        $controllers = glob(App::PLUGINS . DIRECTORY_SEPARATOR . $this->_ctx->layoutPlugin . DIRECTORY_SEPARATOR . Router::CONTROLLER . DIRECTORY_SEPARATOR . '*.php');
        foreach($controllers as $cp)
        {
            $name = basename($cp, '.php');

            include_once $cp;
            $refClass = new ReflectionClass("tsd\\serve\\admin\\{$name}Controller");
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

                $mi = ['url' => $name, 'name' => $miAtt->name, 'children' => []];

                $methods = $refClass->getMethods();
                
                foreach($methods as $m)
                {
                    if ($m->name == "showIndex") continue;

                    $methodName = strtolower(substr($m->name, 4));
                    
                    $miAttrs = $m->getAttributes('tsd\serve\MenuItem');
                    $secUserAttr = $m->getAttributes('tsd\serve\SecurityUser');
                    $secGroupAttrs = $m->getAttributes('tsd\serve\SecurityGroup');

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

                    $mi['children'][] = ['url' => "$name/$methodName", 'name' => $miAtt->name];
                }

                $menu[] = $mi;
            }             
        }

        foreach (App::$plugins as $key=>$pl)
        {
            if (@!$pl['namespace']) continue;
            
            if (file_exists(App::PLUGINS . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . Router::CONTROLLER . DIRECTORY_SEPARATOR . 'admin.php'))
            {
                include_once App::PLUGINS . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . Router::CONTROLLER . DIRECTORY_SEPARATOR . 'admin.php';


                $refClass = new ReflectionClass($pl['namespace'] . '\adminController');
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

                    $mi = ['url' => $key, 'name' => $miAtt->name, 'children' => []];

                    $methods = $refClass->getMethods();
                    
                    foreach($methods as $m)
                    {
                        if ($m->name == "showIndex") continue;

                        $methodName = strtolower(substr($m->name, 4));
                        
                        $miAttrs = $m->getAttributes('tsd\serve\MenuItem');
                        $secUserAttr = $m->getAttributes('tsd\serve\SecurityUser');
                        $secGroupAttrs = $m->getAttributes('tsd\serve\SecurityGroup');

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

                        $mi['children'][] = ['url' => "$key/$methodName", 'name' => $miAtt->name];
                    }

                    $pmenu[] = $mi;
                }        
            }
        }

        $this->_ctx->menu['admin'] = $menu;
        $this->_ctx->menu['plugin'] = $pmenu;

        $this->_ctx->menu['member'] = [['url'=> '/_login/profile', 'name' => 'profile'],['url'=> '/_login/logout', 'name' => 'logout']];
    }   
}
