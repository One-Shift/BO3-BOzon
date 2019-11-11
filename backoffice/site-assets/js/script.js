( function ($) { $.fn.serializeObject = function () { var o = {}; var a = this.serializeArray(); $.each( a, function () { if (o[this.name]) { if (!o[this.name].push) { o[this.name] = [o[this.name]]; } o[this.name].push(this.value || ''); } else { o[this.name] = this.value || ''; } }); return o; }; } )(jQuery);

function editor (target) { CKEDITOR.replace(target); }

$(document).ready(() => {
	/*
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		var element = $("body")[0];
		var options = { preventDefault: true};
		var hammer_obj = new Hammer(element, options);
		hammer_obj.on("panleft panright", (ev) => {
			if (ev.type == "panleft") {
				// $(".sidebar").animate({"margin-left": "-270px"}, {queue: false, duration: "fast"});
			} else if (ev.type == "panright") {
				// $(".sidebar").animate({"margin-left":0}, {queue: false, duration: "fast"});
			}
		});
	}
	*/

	if ($("textarea.editor").length > 0) { $("textarea.editor").each((i, obj) => { editor($(obj).attr("id"));}); }

	// get avatar for login page
	$("body.login input[name=email]").on("focusout", () => { $("#avatar").attr("src", 'https://www.gravatar.com/avatar/' + md5($("input[name=email]").val()) + "?s=240&r=g&d=mm");})

	// get back
	$("body").on( "click", "a#takemeback", () => { window.history.back(); });
});
