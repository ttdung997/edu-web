function hientimkiem() {
    document.getElementsByClassName("formtimkiem")[0].style.display = "block";
}
function hientimkiem2() {
    document.getElementsByClassName("formtimkiem2")[0].style.display = "block";
}
function hienkhung() {
    document.getElementById("box-info").style.display = "block";
}
function dongkhung() {
    document.getElementById("box-info").style.display = "none";
}
function hienkhung2() {
    document.getElementById("box-info2").style.display = "block";
}
function dongkhung2() {
    document.getElementById("box-info2").style.display = "none";
}
function edit_search_button_content_1() {
    document.getElementsByClassName("sreach-button")[1].style.borderRight = "1px solid #66afe9";
}
function edit_search_button_content_2() {
    document.getElementsByClassName("sreach-button")[1].style.borderRight = "none";
}
function edit_search_button_menu_1() {
    document.getElementsByClassName("sreach-button")[0].style.borderRight = "1px solid #66afe9";
}
function edit_search_button_menu_2() {
    document.getElementsByClassName("sreach-button")[0].style.borderRight = "none";
}
function SetCookie(c_name, value, expiredays)
{
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie = c_name + "=" + escape(value) +
            ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
    location.reload()
}