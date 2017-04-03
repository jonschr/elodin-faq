jQuery(document).ready(function($) {
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false,
		header: 'div.faq-section > p.header',
		heightStyle: 'content'
	});
});