<?php

$chunks = array();


$chunk = $modx->newObject('modChunk', array(
    'name'          =>  'modAvatar.output_tpl',
    'description'   => 'Template for userphoto output',
    'snippet'       => getSnippetContent($sources['source_core'].'/elements/chunks/output_tpl.chunk.tpl'),
));
$chunks[] = $chunk;
 

return $chunks;
