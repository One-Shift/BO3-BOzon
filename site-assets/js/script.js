// scripting here
(
	function ($) {
		$.fn.serializeObject = function () { var o = {};
		var a = this.serializeArray();
		$.each(
			a,
			function () {
				if (o[this.name]) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}

					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		};
	}
)(jQuery);

$(document).ready(
	function () {
		// CONTACTS FORM
		$("body").on(
			"click",
			".mod-contacts button",
			function () {
				$.post(
					$(".mod-contacts form").attr("action"),
					$(".mod-contacts form").serializeObject(),
					function (data) {
						data = $.parseJSON(data);
						console.log(data);
						$(".mod-contacts .returnMessage").html(data.message);

						if (data.status === true) {
							$(".mod-contacts form")[0].reset();
						}

						setTimeout(function () {$(".mod-contacts .returnMessage").html("");}, 2500);
					}
				);

				return false;
			}
		);

		new WOW(
			{
				mobile:       false,
			}
		).init();
	}
);
