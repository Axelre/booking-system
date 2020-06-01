function loginerrorhandling()
    {
    var A = document.forms["loginform"]["uid"].value;
    var B = document.forms["loginform"]["pwd"].value;
    if(test_input(A)) {if(test_input(B)) {return true;} else {alert("Fyll i lösenord!"); return false;} } else {alert("Fyll i användarnamn!"); return false;} 
    }

    function registererrorhandling()
    {
    var C = document.forms["createuserform"]["email"].value;
    if(C.length<=2){
        alert("fel format på email"); return false;
    }
    else { if (!test_input(c)) {alert("fel format på email"); return false;} 
    
    else {return true;} 
}

}