<?php

$snippets = array();


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'modAvatar',
    'description' => 'Get user photo',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/modavatar.snippet.php'),
),'',true,true);
              

$properties = array(
    'userid' => array(
        'name' => 'userid',
        'desc' => 'Find user by id',
        'type' => 'textfield',
        'options' => array(),
        'value' => '',
        'lexicon' => '',
        'area' => '',
        'desc_trans' => 'Find user by id',
        'area_trans' => '', 
    ),
    'username' => array(
        'name' => 'username',
        'desc' => 'Find user by username',
        'type' => 'textfield',
        'options' => array(),
        'value' => '',
        'lexicon' => '',
        'area' => '',
        'desc_trans' => 'Find user by username',
        'area_trans' => '', 
    ),
    'email' => array(
        'name' => 'email',
        'desc' => 'Find user by email',
        'type' => 'textfield',
        'options' => array(),
        'value' => '',
        'lexicon' => '',
        'area' => '',
        'desc_trans' => 'Find user by email',
        'area_trans' => '', 
    ),
    'tpl' => array(
        'name' => 'tpl',
        'desc' => 'If set tpl, output will be return via chunk',
        'type' => 'textfield',
        'options' => array(),
        'value' => 'modAvatar.output_tpl',
        'lexicon' => '',
        'area' => '',
        'desc_trans' => 'If set tpl, output will be return via chunk',
        'area_trans' => '', 
    ),
);
$snippet->set('properties', $properties);
$snippets[] = $snippet;


return $snippets;