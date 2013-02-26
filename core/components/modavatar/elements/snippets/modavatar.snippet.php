<?php
$output = '';

// Check filters
if(!$userid && !$username && !$email){
    $modx->log(xPDO::LOG_LEVEL_ERROR, "You should set userid or username or email");
    return $output;
}

// Create query
$where = array(
    'Profile.photo:!=' => '',
);
$q = $modx->newQuery('modUser');
$q->join('modUserProfile', 'Profile');
$q->select(array(
    'modUser.id',
    'modUser.username',
    'Profile.photo',
    'Profile.email',
    'Profile.fullname',
));
$q->limit(1);

if($userid){
    $where['modUser.id'] = $userid;
}
if($username){
    $where['modUser.username'] = $username;
}
if($email){
    $where['Profile.email'] = $email;
}
$q->where($where);

if(!$q->prepare() || !$q->stmt->execute()){
    return $output;
}

// get photo
$data = $q->stmt->fetch(PDO::FETCH_ASSOC);

// get mediasource id
if(!$sourceid = $modx->getOption('modavatar.default_media_source', null)){
    $sourceid = $modx->getOption('default_media_source', null, 1);
}
// get full path
if($source = $modx->getObject('sources.modMediaSource', $sourceid) AND $source->initialize()){
    $data['photo'] = $source->getObjectUrl($data['photo']);
}
if($tpl){
    return $modx->getChunk($tpl, $data);
}
return $data['photo'];