require('es6-shim');

(function() {
	$('form.filter').each(function() {
		var form = $(this);
		var container = $(form.data('container'));
		var items = container.find(form.data('items'));
		var trigger = 'submit';
		var fields = form.find(':input[data-search]');
		var noResults = $('<div class=".no-results"><span></span> <a href="#">Reset?</a></div>');

		var reset = function (items) {
			items.slideDown();
			noResults.detach();
		};

		noResults.find('a').click(function(e) {
			e.preventDefault();
			form[0].reset();
			reset(items);
		});
		

		form.on(trigger, function(e) {
			e.preventDefault();

			var matching = items;

			fields.each(function() {
				var field = $(this);
				var target = $(this).data('search');
				var query = field.val();

				matching = matching.filter(function() {
					var item = $(this);
					var searchIn = target? item.find(target) : item;

					return item.text().toLowerCase().includes(query.toLowerCase());
				});
			});

			reset(matching);
			items.not(matching).slideUp();

			if (matching.length < 1) {
				noResults.find('span').html('There are no matching results');

				if (fields.length == 1) {
					noResults.find('span').append(' for "'+ fields.val() +'"');
				}

				container.after(noResults);
			}
		});
	});
})();