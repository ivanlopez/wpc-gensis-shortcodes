(function() {
    tinymce.create('tinymce.plugins.wpcGenesis', {
        init : function(ed, url) {
            ed.addButton('wpc_buttons', {
                title : 'Buttons',
                cmd : 'buttons',
                icon : 'icon-minus'
            });
 
       
		ed.addButton('wpc_notice-boxes', {
                title : 'Notice Box',
                cmd : 'notice-boxes',
                icon : 'icon-check-empty'
            });
            
		url =  url.replace('/js', '');
            
            ed.addCommand('buttons', function() {
               ed.windowManager.open({
				file : url + '/includes/button-popup.php', // file that contains HTML for our modal window
			      width    : 480,
			      title    : 'Insert Button',
			      height   : 170,
			      inline : 1
                }, {
                        plugin_url : url, // Plugin absolute URL
                });
            });

		ed.addCommand('notice-boxes', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '[notice-box]' + selected_text + '[/notice-box]';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
 
 
        },
	createControl : function(n, cm) {

	if(n=='columns'){
	    var mlb = cm.createListBox('columns', {
	         title : 'columns',
	         onselect : function(v) {
	         	if(tinyMCE.activeEditor.selection.getContent() == ''){
	                tinyMCE.activeEditor.selection.setContent( v )
	            }
	         }
	    });

	    var columnList = ['[grid_6][/grid_6][grid_6][/grid_6]', 
	                      '[grid_4][/grid_4][grid_4][/grid_4][grid_4][/grid_4]', 
	                      '[grid_3][/grid_3][grid_3][/grid_3][grid_3][/grid_3][grid_3][/grid_3]',
	                      '[grid_8][/grid_8][grid_4][/grid_4]',
	                      '[grid_4][/grid_4][grid_8][/grid_8]'];

	    var columnLabels = ['2 Columns', '3 Columns', '4 Columns', 'Right Sidebar', 'Left Sidebar'];

	    for(var i in columnList)
	    	mlb.add(columnLabels[i],columnList[i]);

	    return mlb;
	}
	return null;
	}

        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'wpcGenesis', tinymce.plugins.wpcGenesis );


})();