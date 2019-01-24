( function ($) { $.fn.serializeObject = function () { var o = {}; var a = this.serializeArray(); $.each( a, function () { if (o[this.name]) { if (!o[this.name].push) { o[this.name] = [o[this.name]]; } o[this.name].push(this.value || ''); } else { o[this.name] = this.value || ''; } }); return o; }; } )(jQuery);

function hideMenu (o) {
	o.animate( {'left':'-300px'}, {queue: false, duration: 250});
	$("body").removeClass("noscroll");
}

function showMenu (o) {
	o.animate( {"left": "0"}, {queue: false, duration: 250});
	$("body").addClass("noscroll");
}

function editor (target) { CKEDITOR.replace(target); }

$(document).ready(() => {
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		var element = $("body")[0];
		var options = { preventDefault: true};
		var hammer_obj = new Hammer(element, options);
		hammer_obj.on("panleft panright", (ev) => {
			if (ev.type == "panleft") {
				$(".sidebar").animate({"margin-left": "-270px"}, {queue: false, duration: "fast"});
			} else if (ev.type == "panright") {
				$(".sidebar").animate({"margin-left":0}, {queue: false, duration: "fast"});
			}
		});
	}

	if ($("textarea.editor").length > 0) { $("textarea.editor").each((i, obj) => { editor($(obj).attr("id"));}); }

	$("body").on("click", "#bo-menu-button", () => {
		var container = $("#bo-menu");
		if (container.css("left") != "-300px") { hideMenu(container); } else { showMenu(container); }
	});

	// get avatar for login page
	$("body.login input[name=email]").on("focusout", () => { $("#avatar").attr("src", 'https://www.gravatar.com/avatar/' + md5($("input[name=email]").val()) + "?s=240&r=g&d=mm");})

	// get back
	$("body").on( "click", "a#takemeback", () => { window.history.back(); });

	/*
	ty to http://www.minimit.com/demos/bootstrap-3-open-only-one-modal-at-time
	close opened .modal on opening new modal you can give custom class like this
	var modalUniqueClass = ".modal.modal-unique";
	*/

	var modalUniqueClass = ".modal";
	$('.modal').on(
		'show.bs.modal', function(e) {
			var $element = $(this);
			var $uniques = $(modalUniqueClass + ':visible').not($(this));
			if ($uniques.length) {
				$uniques.modal('hide');
				$uniques.one(
					'hidden.bs.modal',
					function(e) {
						$element.modal('show');
					}
				);
				return false;
			}
		}
	);
});

