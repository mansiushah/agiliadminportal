//Toggle Password
$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
//Dashboard Manu Toggle
$(".menu_toggle").click(function () {
    $(".left_menu").toggleClass("hide");
    $(".right_section").toggleClass("hideone");
    $(".dashboard-list-txt").toggleClass("hidethree");
    $(".text_logo").toggleClass("hidefour");
});
//Dashboard Mobile FManu Toggle
$("#mobile_menu_toggle").click(function () {
    $(".mobile_left_menu").addClass("left_mobile_manu");
});
$(".mobile_menu_close").click(function () {
    $(".mobile_left_menu").removeClass("left_mobile_manu");
});
// Organaization Data Table
$(document).ready(function () {
    $('#CategoryTable').DataTable();
});
$('#OrganisationsTable').DataTable({
     //ordering: false,
    language: {
        searchPlaceholder: "Search organisations...", // <-- placeholder text
        paginate: {
            next: '<i class="fa fa-angle-right">',
            previous: '<i class="fa fa-angle-left">'
        }
    }
});
// Limited Offer hide show
$(".limited_ofr_inpt").click(function () {
    $(".add_maximum_offer_input").addClass("limited_ofr_inpts");
});
$(".unlimited_ofr_inpt").click(function () {
    $(".add_maximum_offer_input").removeClass("limited_ofr_inpts");
});
// Offer  Quata hide show
$('.add_develoer_input').click(function () {
    $('.add_offer_quatabx').removeClass('limited_ofr_inpts')
});
$('.add_advertiser_input').click(function () {
    $('.add_offer_quatabx').addClass('limited_ofr_inpts')
});
$('.add_orgadmin_input').click(function () {
    $('.add_offer_quatabx').addClass('limited_ofr_inpts')
});
// Multiple Categories Select
$(".categories_select").select2({
    closeOnSelect: false,
    placeholder: "Select a category",
    allowClear: true,
    tags: true
});
