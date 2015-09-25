// scripting here
function hideMenu (o) {
    o.animate( {'left':'-300px'}, {queue: false, duration: 500});
}

function showMenu (o) {
    o.animate( {"left": "0"}, {queue: false, duration: 500});
}

$(document).ready(function () {
    $("#bo-menu-button").on("click", function () {
        var container = $("#bo-menu");
        showMenu(container);
    });

    // get avatar for login page
    $("body.login input[name=name]").on("focusout",
        function () {
            $("#avatar").attr("src", 'http://www.gravatar.com/avatar/' + md5($("input[name=name]").val()) + "?s=240&r=g&d=mm");
        }
    )
});

$(document).mouseup(function (e) {
    var container = $("#bo-menu");
    if (!container.is(e.target) /* if the target of the click isn't the container... */ && container.has(e.target).length === 0) {
        hideMenu(container);
    }
});
