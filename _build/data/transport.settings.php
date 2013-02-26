<?php

$settings = array();

$setting = $modx->newObject('modSystemSetting');
$setting->fromArray(array(
    'key' => 'modavatar.default_media_source',  
    'value' => '1',
    'xtype' => 'modx-combo-source',    
    'namespace' => NAMESPACE_NAME,
    'area' => 'site',
),'',true,true);
$settings[] = $setting;
unset($setting);

return $settings;