function hideMenu (o) {
    o.animate( {'left':'-300px'}, {queue: false, duration: 250});
    $("body").removeClass("noscroll");
}

function showMenu (o) {
    o.animate( {"left": "0"}, {queue: false, duration: 250});
    $("body").addClass("noscroll");
}

function editor (target) {
    CKEDITOR.replace(target);
}

$(document).ready(
    function () {
        $("body").on(
            "click",
            "#bo-menu-button",
            function () {
                var container = $("#bo-menu");

                if (container.css("left") != "-300px") {
                    hideMenu(container);
                } else {
                    showMenu(container);
                }
            }
        );

        // get avatar for login page
        $("body.login input[name=email]").on("focusout",
            function () {
                $("#avatar").attr("src", 'http://www.gravatar.com/avatar/' + md5($("input[name=email]").val()) + "?s=240&r=g&d=mm");
            }
        )

        // logout
        $("body").on(
            "click",
            "a#logout",
            function () {
                document.cookie = cookie + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT; PATH='+((path != "") ? path : "/");
                window.location = path_bo;
                return false;
            }
        );

        // get back
        $("body").on(
            "click",
            "a#takemeback",
            function () {
                window.history.back();
            }
        );


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
    }
);

$(document).mouseup(
    function (e) {
        var container = $("#bo-menu");
        if (!container.is(e.target) /* if the target of the click isn't the container... */ && container.has(e.target).length === 0) {
            hideMenu(container);
        }
    }
);
