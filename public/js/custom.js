"use strict";
$(function () {
    const sidebarHideAt = 1265; //at or below
    $("#sidebar-toggle").on("click", function (e) {
        e.preventDefault();
        $("main#main").toggleClass("toggled");
        if ($(window).width() <= sidebarHideAt) {
            if (!$("aside.sidebar").hasClass("sidebar-resize")) {
                $("aside.sidebar").addClass("sidebar-resize");
            }
        } else {
            if ($("aside.sidebar").hasClass("sidebar-resize")) {
                $("aside.sidebar").removeClass("sidebar-resize");
            }
        }
    });
    function sidebarClose() {
        if ($(window).width() <= sidebarHideAt) {
            if ($("main#main").hasClass("toggled")) {
                $("main#main").removeClass("toggled");
            }
        }
    }
    sidebarClose();
    $(window).on("resize", function (e) {
        if ($(window).width() <= sidebarHideAt) {
            $("main#main").removeClass("toggled");
            $("aside.sidebar").css({
                position: "absolute",
                "z-index": "126",
            });
        } else {
            $("main#main").addClass("toggled");
            $("aside.sidebar").css("position", "relative");
        }
    });
    $(document).on("mouseup", function (e) {
        const getSidebar = $("aside.sidebar");

        if ($(window).width() <= sidebarHideAt) {
            if (
                !getSidebar.is(e.target) &&
                getSidebar.has(e.target).length === 0
            ) {
                $("main#main").removeClass("toggled");
            }
        }
    });
    $("#submitButton").on("click", function (e) {
        if ($(this).hasClass("cursor-none")) {
            e.preventDefault();
        }
    });
    $("#condition").on("change", function () {
        let getText = $("#condition option:selected").text();
        $("#submitButton").attr("value", getText);
        $("#submitButton").removeClass("cursor-none");
    });
    $(".tableRow").on("click", function (e) {
        let getLink = this.getAttribute("data-link");
        window.location.href = getLink;
    });
});
