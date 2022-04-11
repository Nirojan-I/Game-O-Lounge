
function toggle() {
	window.location.href="signup.html"; 
}

var model = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == model) {
        model.style.display = "none";
    }
}
