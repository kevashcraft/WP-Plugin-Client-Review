function cr_getter(that) {
	if(that.value.length >= 7) {
		var cr_ac = that.value;
		jQuery.post(ClientReview.ajaxurl, { action: 'cr_showreview', cr_ac: cr_ac },function (response){
			document.getElementById('cr_review').innerHTML = response;
			if(document.getElementById('cr_ac') != null) {
				document.getElementById('cr_ac').focus();
			}
//			console.log(response);
//			rarray = JSON.parse(response);
		});
	}
}
