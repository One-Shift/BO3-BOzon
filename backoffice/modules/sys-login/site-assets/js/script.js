function seePassword() {
    var password = document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

$(document).ready(function(){

    $(".password .input-group-btn span").click(function() {
        $("i", this).toggleClass("fa-eye fa-eye-slash");
    });

});
