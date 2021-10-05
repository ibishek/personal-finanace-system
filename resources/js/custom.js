$(function () {
    $("#sidebarCollapse, #sidebar-close").on("click", function () {
        $("#sidebar, #content").toggleClass("active");
        $("#sidebar-close").toggleClass("active");
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
