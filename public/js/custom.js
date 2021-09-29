"use strict";
// @ts-check
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
            if ($("section#section").hasClass("col-md-10")) {
                $("section#section")
                    .removeClass("col-md-10")
                    .addClass("col-md-12");
            } else {
                $("section#section")
                    .removeClass("col-md-12")
                    .addClass("col-md-10");
            }
        }
    });
    function sidebarClose() {
        if ($(window).width() <= sidebarHideAt) {
            if ($("main#main").hasClass("toggled")) {
                $("main#main").removeClass("toggled");
            }
            $("section#section").removeClass("col-md-10").addClass("col-md-12");
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
            $("section#section").removeClass("col-md-10").addClass("col-md-12");
        } else {
            $("main#main").addClass("toggled");
            $("aside.sidebar").css("position", "relative");
            $("section#section").removeClass("col-md-12").addClass("col-md-10");
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
    $(".href-row").on("click", function (e) {
        let getUrl = $(this).attr("data-link");
        window.location.href = getUrl;
    });
    $("input[type=text]").on("keyup", function (e) {
        if (e.key == "Escape") {
            $(this).val("");
        }
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".format-amount").each(function () {
        $(this).text(accounting.formatNumber($(this).attr("data-amount"), 2));
    });
});
