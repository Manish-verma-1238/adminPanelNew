$(document).ready(function () {
    new WOW().init();

    $(".sidebarNavigation .navbar-collapse").hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show();
    $("body").append("<div class='overlay'></div>");

    $(".navbar-toggle, .navbar-toggler").on("click", function () {
        $(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass"));
        $(".sideMenu, .overlay").toggleClass("open");

        $(".overlay").on("click", function () {
            $(this).removeClass("open");
            $(".sideMenu").removeClass("open");
        });
    });

    $("body").on("click", ".sideMenu.open .nav-item", function () {
        if (!$(this).hasClass("dropdown")) {
            $(".sideMenu, .overlay").toggleClass("open");
        }
    });

    $(window).resize(function () {
        if ($(".navbar-toggler").is(":hidden")) {
            $(".sideMenu, .overlay").hide();
        } else {
            $(".sideMenu, .overlay").show();
        }
    });

    $(".typewrite").each(function () {
        var a = $(this).attr("data-type");
        var o = $(this).attr("data-period");
        if (a) {
            new TxtType($(this)[0], JSON.parse(a), o);
        }
    });

    var i = document.createElement("style");
    i.type = "text/css";
    i.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(i);
});
