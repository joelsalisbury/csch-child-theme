;(function($) {

	function arr_last(arr) {
		return arr[arr.length-2];
	}

	$('#menu-categories>li.menu-item>a').each(function() {
		if($(this).html() == "Show All") {
			$(this).addClass('active');
		}
	});

	$('#menu-media-archive-categories>li.menu-item>a').each(function() {
		if($(this).html() == "Show All") {
			$(this).addClass('active');
		}
	});

	$('#menu-categories>li.menu-item>a').on('click', function(e) {
		e.preventDefault();

		var previousCategory = arr_last($('#menu-categories>li.menu-item>a.active').attr('href').split('/'));
		//console.log(previousCategory);

		var nextCategory = arr_last($(this).attr('href').split('/'));
		//console.log(nextCategory);

		$('.panel-post').each(function() {
			if(nextCategory != 'all-categories') {
				if(!$(this).hasClass('category-' + nextCategory)) {
					$(this).fadeOut(500);
				}
			} else {
				$(this).fadeIn(500);
			}
		});
	});

	$('#menu-media-archive-categories>li.menu-item>a').on('click', function(e) {
		e.preventDefault();

		var previousCategory = arr_last($('#menu-media-archive-categories>li.menu-item>a.active').attr('href').split('/'));
		//console.log(previousCategory);

		var nextCategory = arr_last($(this).attr('href').split('/'));
		//console.log(nextCategory);

		$('.panel-post').each(function() {
			if(nextCategory != 'all-categories') {
				if(!$(this).hasClass('category-' + nextCategory)) {
					$(this).fadeOut(500);
				}
			} else {
				$(this).fadeIn(500);
			}
		});
	});

})( jQuery );
