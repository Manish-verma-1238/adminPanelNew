
new WOW().init(),
    (window.onload = function () {
        window.jQuery
            ? $(document).ready(function () {
                $(".sidebarNavigation .navbar-collapse").hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show(),
                    $("body").append("<div class='overlay'></div>"),
                    $(".navbar-toggle, .navbar-toggler").on("click", function () {
                        $(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass")),
                            $(".sideMenu, .overlay").toggleClass("open"),
                            $(".overlay").on("click", function () {
                                $(this).removeClass("open"), $(".sideMenu").removeClass("open");
                            });
                    }),
                    $("body").on("click", ".sideMenu.open .nav-item", function () {
                        $(this).hasClass("dropdown") || $(".sideMenu, .overlay").toggleClass("open");
                    }),
                    $(window).resize(function () {
                        $(".navbar-toggler").is(":hidden") ? $(".sideMenu, .overlay").hide() : $(".sideMenu, .overlay").show();
                    });
            })
            : console.log("sidebarNavigation Requires jQuery");
        for (var e = document.getElementsByClassName("typewrite"), t = 0; t < e.length; t++) {
            var a = e[t].getAttribute("data-type"),
                o = e[t].getAttribute("data-period");
            a && new TxtType(e[t], JSON.parse(a), o);
        }
        var i = document.createElement("style");
        (i.type = "text/css"), (i.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}"), document.body.appendChild(i);
    });
