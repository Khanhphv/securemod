$(document).ready(function() {
	"use strict";
	var now = new Date().getTime();
	if (localStorage.getItem("last_time_show_popup") === null) {
		localStorage.setItem("last_time_show_popup", now);
		$('.poup_background').show();
	} else if (now - parseInt(localStorage.getItem("last_time_show_popup")) > 600000) {
		localStorage.setItem("last_time_show_popup", now);
		$('.poup_background').show();
	} 
	$('#close_promo_popup').click(function() {
		$('.poup_background').remove();
	});
});