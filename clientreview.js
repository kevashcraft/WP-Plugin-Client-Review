function cr_getter(that) {
	if(that.value.length >= 7) {
		var cr_ac = that.value;
		jQuery.post(ClientReview.ajaxurl, { action: 'cr_showreview', cr_ac: cr_ac },function (response){
			document.getElementById('crpi_review').innerHTML = response;
			if(document.getElementById('crpi_ac') != null) {
				document.getElementById('crpi_ac').focus();
			} else {
				console.log('js loaded');
				var cr_selected_note = 'none';
				jQuery('#crpi_review li').click(function ($) {
					console.log('hello kevin');
					clearTimeout(cr_timeout);
					var note_div = jQuery(this).children();
					if(note_div.attr('data-crnot') != 'shown') {	
						jQuery(this).addClass('active');
						note_div.attr('data-crnot', 'shown');
						cr_selected_note = jQuery(this);
						jQuery(this).children().animate({right: '+=100%'},750);
					}
				});
	
				var cr_timeout;
				cr_timeout = setTimeout(function () {
					if(cr_selected_note == 'none') {
						var td = jQuery('#crpi_review li:first-of-type');
						var note_div = td.children()
						note_div.attr('data-crnot', 'shown');
						td.addClass('active');
						cr_selected_note = td;
						note_div.animate({right: '+=100%'},1000);
					}
					
				},5000);
			
				jQuery(document).mouseup(function (e) {
					if(cr_selected_note != 'none') {
						container = cr_selected_note.children();
						console.log(container);
				    	if (!cr_selected_note.is(e.target) && !container.is(e.target) && container.has(e.target).length === 0) {
							console.log('here');
							cr_selected_note.removeClass('active');
							cr_selected_note.children().animate({right: '-=100%'},500);
							cr_selected_note.children().attr('data-crnot', 'hidden');
							cr_selected_note = 'none';
						}
					}
				});			
			}
		});
	}
}
