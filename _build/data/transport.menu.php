<?php
  
$menus  =  array();
$childes  =  array();

    $action= $modx->newObject('modAction');
    $action->fromArray(array(
        'id' => 1,
        'namespace' => NAMESPACE_NAME,
        'parent' => 0,
        'controller' => 'controllers/buro/',
        'haslayout' => 1,
        'lang_topics' => 'yleyjkh:default',
        'assets' => '',
    ),'',true,true);

    /* load action into menu */
    $menu= $modx->newObject('modMenu');
    $menu->fromArray(array(
        'text' => 'yleyjkh_buro',
        'description' => 'yleyjkh_buro_desc',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions'   => 'yleyjkh.view_buro_panel',
    ),'',true,true);
    $menu->addOne($action);
    $childes[] = $menu;
    unset($action);

    $action= $modx->newObject('modAction');
    $action->fromArray(array(
        'id' => 1,
        'namespace' => NAMESPACE_NAME,
        'parent' => 0,
        'controller' => 'controllers/order/',
        'haslayout' => 1,
        'lang_topics' => 'yleyjkh:default',
        'assets' => '',
    ),'',true,true);

    /* load action into menu */
    $menu= $modx->newObject('modMenu');
    $menu->fromArray(array(
        'text' => 'yleyjkh_order',
        'description' => 'yleyjkh_order_desc',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions'   => 'yleyjkh.view_order_panel',
    ),'',true,true);
    $menu->addOne($action);
    $childes[] = $menu;
    unset($action);

    $action= $modx->newObject('modAction');
    $action->fromArray(array(
        'id' => 1,
        'namespace' => NAMESPACE_NAME,
        'parent' => 0,
        'controller' => 'controllers/admin/',
        'haslayout' => 1,
        'lang_topics' => 'yleyjkh:default',
        'assets' => '',
    ),'',true,true);

    /* load action into menu */
    $menu= $modx->newObject('modMenu');
    $menu->fromArray(array(
        'text' => 'yleyjkh_admin',
        'description' => 'yleyjkh_admin_desc',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions'   => 'yleyjkh.view_admin_panel',
    ),'',true,true);
    $menu->addOne($action);
    $childes[] = $menu;
    unset($action);
    
    
    
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => NAMESPACE_NAME,
    'parent' => 0,
    'controller' => 'yleyjkh/home',
    'haslayout' => 1,
    'lang_topics' => 'yleyjkh:default',
    'assets' => '',
),'',true,true);

/* load action into menu */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'yleyjkh',
    'parent' => 'components',
    'description' => 'yleyjkh_desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => 0,
    'params' => '',
    'handler' => 'return false;',
    'permissions'   => 'yleyjkh.view_home_panel',
),'',true,true);
$menu->addOne($action);
$menu->addMany($childes, 'Children');

return $menu;