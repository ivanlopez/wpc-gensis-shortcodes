<?php
// this file contains the contents of the popup window
    $wpc_url = wpc_url();
	function wpc_url()
	{
	    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	    $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
	    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	    $url = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	    $url = explode("wp-content", $url);
	    return $url[0] ;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Button</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $wpc_url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>


<script>

	var ButtonDialog = {
	      local_ed : 'ed',
	      init : function(ed) {
	            ButtonDialog.local_ed = ed;
	      },

	      insert : function insertButton(ed) {
	         
	      // Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
	                 
	      var url = jQuery('#wpc-url').val();
	      var type = jQuery('#wpc-button').val();
		var output = '';

	      // setup the output of our shortcode
	      output = '[button url='+url+' type=' + type + ']'+ ButtonDialog.local_ed.selection.getContent() + '[/button]';
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
	                 
	      // Return
	      tinyMCEPopup.close();
	      }
      };
      tinyMCEPopup.onInit.add(ButtonDialog.init, ButtonDialog);

</script>

<style>
	#wpc-url {
      	width: 300px;
    		padding: 6px;
	}

	#wpc-button {
	    height: 25px;
	}

	.button-primary {
	    padding: 9px;
}
</style>

</head>
<body>

	<div style="padding:20px;" id="wpc-button-dialog">
		      <div style="margin-bottom:15px;">
		      	<label for="wpc-url" style="margin-right: 60px;">URL</label>
		       	<input type="text" name="wpc-url" id="wpc-url" />
		      </div>
		      <div style="margin-bottom:15px;">
		      	<label for="wpc-button" style="margin-right: 10px;">Button Type</label>
		       	<select name="wpc-button" id="wpc-button">
		       		<option value="btn-default">Default</option>
		       		<option value="btn-primary">Primary</option>
		       		<option value="btn-secondary ">Secondary</option>
		       		<option value="btn-success">Green</option>
		       		<option value="btn-info">Blue</option>
		       		<option value="btn-danger">Red</option>
		       	</select>
		      </div>
		      <div>
		        <input type="submit" onclick="javascript:ButtonDialog.insert(ButtonDialog.local_ed)" class="button-primary" value="Insert Button" />
		      </div>
	</div>
</body>
</html>