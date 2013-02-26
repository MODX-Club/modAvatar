MODx.ux.modAvatar.widget.UserPanel = function(config){
    config = config || {};
     
    Ext.applyIf(config, {
        border: false
        ,title: _('user_photo')
        ,source: config.source || 1
    });
    
    this.setup(config);
};

Ext.extend(MODx.ux.modAvatar.widget.UserPanel, Ext.form.FieldSet, {
    
    setup: function(config){
        
        this.userPanel = config.panel || {}
        
        this.preview = MODx.load({
            xtype: 'container'
            ,listeners:{
                afterrender: {
                    scope: this
                    ,fn: function(){
                        this.onSelect({
                            url:  config.photo || ''
                            ,relativeUrl:  config.photo || ''
                        }, true);
                    }
                }
            }
        });
        
        this.photoFieild = MODx.load({
            xtype: 'hidden'
            ,name: 'photo'
            ,value: config.photo || ''
        });
        
        config.items = [
            this.photoFieild
            ,{
                xtype: 'modx-panel-tv-image'
                ,value: config.photo || ''
                ,relativeValue: config.photo || ''
                ,scope: this
                ,listeners: {
                    select: {scope: this, fn: this.onSelect}
                }
                ,source: config.source
            }
            ,this.preview
        ];
        
        MODx.ux.modAvatar.widget.UserPanel.superclass.constructor.call(this, config);
        
        this.addEvents({
            'beforeUpload': true
            ,'afterUpload': true
            ,'fileBrowserSelect': true
            ,'changeSource': true
        });
        
        this.on('fileBrowserSelect', this.fileBrowserSelect, this);
    } 
    
    ,onSelect: function(data, noEvent){
        if(!noEvent){
            this.userPanel.fireEvent('fieldChange'); 
        }
        var d = this.preview;
        if (Ext.isEmpty(data.url)) {
                    d.update('');
        }
        else{ 
            d.update('<img src="'+MODx.config.connectors_url+'system/phpthumb.php?h=150&w=150&src='+data.url+'&wctx=MODx.ctx&source='+this.getSource()+'" alt="" />');        
        }
        this.photoFieild.setValue(data.relativeUrl);
    }
    
    ,getSource: function(){
        return this.source;
    }
});
