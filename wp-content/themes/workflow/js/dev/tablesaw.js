// calls tablesaw plugin if content area has a table in it
// upgrades wordpress WYSIWYG tables to be ready for tablesaw enchancement
// https://github.com/filamentgroup/tablesaw

// to make this work the table needs to appear in the article tag
// and Worrdpress set up to allow tables in TinymCE - use TinyMCE Advanced plugin - https://wordpress.org/plugins/tinymce-advanced/


jQuery(function($) {
	
	// only apply if there's a table in the content area
	if( $("article table").length != 0){    

		// don't apply to tables with the .noTablesaw class
		$("table:not(.noTablesaw)").each(function(){

			// Tinymce doesn't apply TH tag to header cells, so convert them (TH needed for tablesaw) 
			$('article table thead td').each(function() {
			    $(this).replaceWith("<th>"+$(this).html()+"</th>")
			});

			// add rqd classes to table 
            var currentTable = $(this);
            currentTable.addClass('tablesaw tablesaw-stack');
            currentTable.attr("data-tablesaw-mode", "stack");
		});

		// manually trigger tablesaw
		$("article").trigger( "enhance.tablesaw" );
	}

});
