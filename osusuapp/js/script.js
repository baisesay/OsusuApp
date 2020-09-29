let showMenu = false;

function navShow() {
    const nav = document.getElementById("nav-bar");
    const menuBtn = document.getElementById("menu-toggle");

    if (!showMenu) {
        menuBtn.classList.add("close");
        nav.classList.add("active");

        showMenu = true;
    } else {
        menuBtn.classList.remove("close");
        nav.classList.remove("active");
        showMenu = false;
    }
}

function checktextbox() {
    if (document.getElementById("search-text").value == "") {
        alert("Please enter the customer osusuid");

        return false;
    }
}

$(document).ready(function() {
    //Openng account section
    $(".view-account").click(function() {
        $(".new-account-form").hide();
        $(".view-account-form").show();
        $(".new-account").css("background", "none");
        $(".view-account").css("background", "var(--plain-white)");
    });

    $(".new-account").click(function() {
        $(".new-account-form").show();
        $(".view-account-form").hide();
        $(".view-account-form").css("height", "100px");
        $(".new-account").css("background", "var(--plain-white)");
        $(".view-account").css("background", "none");
        $(".form-details").hide();
    });

    //Board section

    $(".view-board").click(function() {
        $(".new-board-form").hide();
        $(".view-board-section").show();
        $(".new-board").css("background", "none");
        $(".view-board").css("background", "var(--plain-white)");
    });

    $(".new-board").click(function() {
        $(".new-board-form").show();
        $(".view-board-section").hide();
        $(".new-board").css("background", "var(--plain-white)");
        $(".view-board").css("background", "none");
    });

    //logout

    $("#logout").on("click", function(e) {
        e.preventDefault();
        var logout = $(this).attr("href");
        swal
            .fire({
                title: "LOGOUT!",
                text: "Do you want to logout?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3885d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout",
            })
            .then((result) => {
                if (result.value) {
                    document.location.href = logout;
                }
            });
    });
});