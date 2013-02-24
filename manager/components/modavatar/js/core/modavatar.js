MODx.ux = MODx.ux || {}
MODx.ux.modAvatar = function(config){
    config = config || {};
    Ext.applyIf(config,{
        lexicon:{}
    });
    MODx.ux.modAvatar.superclass.constructor.call(this, config);
}

Ext.extend(MODx.ux.modAvatar, MODx.Component,{
    widget:{}
    
    ,_: function(w){
        return this.lexicon[w] || _(w);
    }
});

Ext.reg('modx-ux-modavatar','MODx.ux.modAvatar');