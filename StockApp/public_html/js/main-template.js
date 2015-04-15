$(document).ready(function(){
	$("#gallery").delegate(".photo","mouseenter",function(){
		$(this).find(".details").fadeIn();
	  });
	$("#gallery").delegate(".photo","mouseleave",function(){
		$(".details").fadeOut();
	  });
	
	$("#more-photos").click(function(e){
		e.preventDefault();
		
		var _this = $(this);
		var href = _this.attr('href');
		var slashPos = href.indexOf('/');
		var dotPos = href.indexOf('.');
		var next = parseInt(href.substring(slashPos + 1, dotPos));

		// return false;
		
		$.get('pages/' + next + '.html', function(data,status){
			$('#gallery').append(data);
			
			_this.attr('href', 'pages/'+(++next)+'.html');
			
			if (next === 20) {
				_this.remove();
			}
		});
	});
});
//b) Attach event handler for 'more photos' link
//Using AJAX 'get', fetch the next photo page saved in the link.
//Append the page to the current page.
//If still pages left, change the attribute href in link More Photos to point to the next page. 
//If no pages left remove the link.