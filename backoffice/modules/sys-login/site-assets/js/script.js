$(document).ready(function () {
	setTimeout(function () {
		$('.container').fadeIn(500);
	}, 500);

	/* login avatar */
	$("body.login .form_login input[name=input-email]").on("focusout", function () {
		var email = $(".form_login input[name=input-email]").val();
		if (email !== "") {
			var email_md5 = md5(email),
			img_src = 'https://www.gravatar.com/avatar/' + email_md5 + "?s=240&r=g&d=mm";

			$(".form_login .avatar").attr("src", img_src);
		}
	});

	/* register avatar */
	$("body.login .form_register input[name=input-email]").on("focusout", function () {
		var email = $(".form_register input[name=input-email]").val();
		if (email !== "") {
			var email_md5 = md5(email),
			img_src = 'https://www.gravatar.com/avatar/' + email_md5 + "?s=240&r=g&d=mm";

			$(".form_register .avatar").attr("src", img_src);
		}
	});
});
