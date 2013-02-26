<?php
switch($modx->event->name){
    case 'OnUserFormPrerender':
        $modx->lexicon->load('modavatar:default');
        
        $mgrUrl = $modx->getOption('manager_url',null,MODX_MANAGER_URL);
        $modx->regClientStartupScript($mgrUrl.'assets/modext/widgets/element/modx.panel.tv.renders.js');
         
        $photo;
        
        if($scriptProperties['user']->Profile){
            $photo = $scriptProperties['user']->Profile->get('photo');
        }
        
        if(!$path = $modx->getOption('modavatar.manager_url', null)){
            $path = $modx->getOption('manager_url', null).'components/modavatar/';
        }
        $path .= 'js/';
        
        if(!$source = $modx->getOption('modavatar.default_media_source', null)){
            $source = $modx->getOption('default_media_source', null, 1);
        }
        
        $modx->regClientStartupScript($path.'core/modavatar.js');
        
        $lexicon = (array)$modx->lexicon->loadCache('modavatar');
        $modx->regClientStartupScript( '<script type="text/javascript">
            MODx.ux.modAvatar = new MODx.ux.modAvatar({
                lexicon: '.$modx->toJSON($lexicon).'
            });
</script>',true);
        $modx->regClientStartupScript($path.'widgets/userpanel.js');
        $modx->regClientStartupScript( '<script type="text/javascript">
            Ext.onReady(function(){
                var tab = Ext.getCmp("modx-user-tabs");
                var panel = Ext.getCmp("modx-panel-user");
                var infotab = tab.find("title", _("general_information"));
                var infopanel;
                var user;
                try{
                    user = infotab[0].get(0);
                    infopanel = user.get(0);
                }
                catch(e){
                    return;
                }  
                var fieldset = new MODx.ux.modAvatar.widget.UserPanel({
                    panel: panel
                    ,photo: "'.$photo.'"
                    ,source: '.$source.'
                });
                infopanel.add(fieldset);
            });
</script>',true);
        break;
}