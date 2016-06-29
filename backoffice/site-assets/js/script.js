// scripting here
function hideMenu (o) {
    o.animate( {'left':'-300px'}, {queue: false, duration: 250});
}

function showMenu (o) {
    o.animate( {"left": "0"}, {queue: false, duration: 250});
}

$(document).ready(function () {
    $("#bo-menu-button").on("click", function () {
        var container = $("#bo-menu");
        showMenu(container);
    });

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
});

$(document).mouseup(function (e) {
    var container = $("#bo-menu");
    if (!container.is(e.target) /* if the target of the click isn't the container... */ && container.has(e.target).length === 0) {
        hideMenu(container);
    }
});
