/* [ ---- extended form elements ---- ] */

	$(document).ready(function() {
		//* WYSIWG editor
        bbfl_wysiwg.init();
        //* multiupload
        //bbfl_multiupload.init();
        

	});
	
    //* TinyMce
	bbfl_wysiwg = {
		init: function(){
			// File Browser
            //function openKCFinder(field_name, url, type, win) {
            //    alert("Field_Name: " + field_name + "nURL: " + url + "nType: " + type + "nWin: " + win); // debug/testing
            //    tinyMCE.activeEditor.windowManager.open({
            //        file: 'admin/plugins/file-manager/browse.php?opener=tinymce&type=' + type,
            //        title: 'KCFinder',
            //        width: 700,
            //        height: 500,
            //        resizable: "yes",
            //        inline: true,
            //        close_previous: "no",
            //        popup_css: false
            //    }, {
            //        window: win,
            //       input: field_name
            //    });
            //    return false;
            //};
            $('textarea#wysiwg_full').tinymce({
                // Location of TinyMCE script
                script_url 							: '/js/admin/plugins/tiny_mce/tiny_mce.js',
                // General options
                theme 								: "advanced",
                plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
                // Theme options
                theme_advanced_buttons1 			: "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
                theme_advanced_buttons2 			: "forecolor,backcolor,|,cut,copy,paste,pastetext,|,bullist,numlist,link,image,media,|,code,preview,fullscreen",
                theme_advanced_buttons3 			: "",
                theme_advanced_toolbar_location 	: "top",
                theme_advanced_toolbar_align 		: "left",
                theme_advanced_statusbar_location 	: "bottom",
                theme_advanced_resizing 			: false,
                font_size_style_values 				: "8pt,10px,12pt,14pt,18pt,24pt,36pt",
                init_instance_callback				: function(){
                    function resizeWidth() {
                        document.getElementById(tinyMCE.activeEditor.id+'_tbl').style.width='100%';
                    }
                    resizeWidth();
                    $(window).resize(function() {
                        resizeWidth();
                    })
                }
                // file browser
                //file_browser_callback: function openKCFinder(field_name, url, type, win) {
                //    tinyMCE.activeEditor.windowManager.open({
                //        file: 'admin/plugins/file-manager/browse.php?opener=tinymce&type=' + type + '&dir=image/themeforest_assets',
                //        title: 'KCFinder',
                //        width: 700,
                //        height: 500,
                //        resizable: "yes",
                //        inline: true,
                //        close_previous: "no",
                //        popup_css: false
                //    }, {
                //        window: win,
                //        input: field_name
                //    });
                //    return false;
                //}
            });
		}
	};
    
	//* drag&drop multi-upload
    bbfl_multiupload = {
        init: function() {
            $("#multi_upload").pluploadQueue({
                // General settings
                runtimes : 'html5,flash,silverlight',
                url : 'lib/plupload/examples/upload.php',
                max_file_size : '10mb',
                chunk_size : '1mb',
                unique_names : true,
                browse_button : 'pickfiles',
        
                // Specify what files to browse for
                filters : [
                    {title : "Image files", extensions : "jpg,gif,png"},
                    {title : "Zip files", extensions : "zip"}
                ],
        
                // Flash settings
                flash_swf_url : 'lib/plupload/js/plupload.flash.swf',
        
                // Silverlight settings
                silverlight_xap_url : 'lib/plupload/js/plupload.silverlight.xap'
            });
        }
    };
	
	
	