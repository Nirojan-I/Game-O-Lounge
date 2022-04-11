function toggle() {
	window.location.href="login page.html"; 
}
function passwordCheck(a,b){
var passFormat=/^\w+([\.-]?\w+)$/;
if(passFormat.test(a))
{   
if(a==b){
return true;}
else{
alert('confirm Password doesn\'t match!');
document.myForm.password2.focus();
return false;}
}  
else  
{  
alert("You have entered an invalid Password!");
document.myForm.password1.focus();
return false;
}

}
function emailCheck(str)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(mailformat.test(str))
{  
return true; 
}  
else  
{  
alert("You have entered an invalid email address!");
document.myForm.email.focus();
return false;
}
}
function checkForm(a,b,c){
var x=emailCheck(a);
if(x==true){
var y=passwordCheck(b,c);
if(x==true && y==true){
return true;}
else return false;
}
else return false;
}