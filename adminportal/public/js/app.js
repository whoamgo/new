(function () {
	'use strict';

	function handleAjaxForm(form) {
		const $form = $(form);
		$form.on('submit', function (e) {
			e.preventDefault();
			const submitBtn = $form.find('[type=submit]');
			submitBtn.prop('disabled', true);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method') || 'POST',
				data: $form.serialize(),
				dataType: 'json'
			}).done(function (res) {
				if (res.redirect) window.location.href = res.redirect;
				if (res.message) alert(res.message);
			}).fail(function (xhr) {
				const msg = xhr.responseJSON?.message || 'Request failed';
				alert(msg);
			}).always(function () {
				submitBtn.prop('disabled', false);
			});
		});
	}

	window.initAjaxForms = function () {
		$('form[data-ajax=true]').each(function () { handleAjaxForm(this); });
	};

	$(document).ready(function () {
		initAjaxForms();
	});
})();