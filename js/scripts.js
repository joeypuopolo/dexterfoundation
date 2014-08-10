// 
//  USED FOR BY HOVER FOR THE NAV BAR
// 
function visible(element) {
    document.getElementById(element).style.visibility = 'visible';
}

function invisible(element) {
    document.getElementById(element).style.visibility = 'hidden';
}

// used to validate the emails on the dog application
function email_validate() {
    if (document.getElementById("EMAIL_ONE").value != document.getElementById("EMAIL_TWO").value) {
        document.getElementById("EMAIL_TWO").focus();
        alert("Oops! Please double check your email entries.");
    }

}
