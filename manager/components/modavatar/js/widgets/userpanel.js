MODx.ux.modAvatar.widget.UserPanel = function(config){
    config = config || {};
     
    Ext.applyIf(config, {
        border: false
        ,title: _('user_photo')
        //,tbar:[]
        //,uploadButton:{}
    });
    
    /*Ext.applyIf(config.uploadButton, {
        text: _('upload')
    });*/
    
    this.setup(config);
};

Ext.extend(MODx.ux.modAvatar.widget.UserPanel, Ext.form.FieldSet, {
    
    browser: null
    
    ,setup: function(config){
        //this.UploadButton = new Ext.ux.UploadDialog.BrowseButton(config.uploadButton);
        
        /*Ext.applyIf(config.tbar, [
            this.UploadButton
        ]);*/
        
        /*if(MODx.perm.file_manager){
            config.tbar.push( {
                icon: MODx.config.manager_url+'templates/default/images/restyle/icons/file_manager.png'
                ,scope: this
                ,tooltip: {text: _('modx_browser')}
                ,text: MODx.ux.modAvatar._('modavatar.select_file')
                ,handler: this.loadFileManager
                ,hidden: MODx.perm.file_manager && !MODx.browserOpen ? false : true
            });
        } */
        
        this.userPanel = config.panel || {}
        
        this.source = config.source || 1;
        
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
    
    ,loadFileManager: function(btn,e) { 
        var refresh = false;
        if (this.browser === null) {
            this.browser = MODx.load({
                xtype: 'modx-browser'
                ,hideFiles: true
                ,rootVisible: false
                ,wctx: MODx.ctx
                ,source: this.getSource()
                ,listeners: {
                    'select': {fn: function(data) {
                        this.fireEvent('fileBrowserSelect',data);
                    },scope:this}
                }
            });
        } else {
            refresh = true;
        }
        if (this.browser) {
            this.browser.setSource(this.getSource());
            if (refresh) {
                this.browser.win.tree.refresh();
            }
            this.browser.show();
        }
    }
    
    ,getSource: function(){
        return 1;
    }
});
