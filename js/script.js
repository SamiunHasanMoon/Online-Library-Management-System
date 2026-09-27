function validateForm(){

    let name = document.forms["registerForm"]["name"].value;

    let email = document.forms["registerForm"]["email"].value;


    if(name == ""){

        alert("Please enter your name");

        return false;

    }


    if(email == ""){

        alert("Please enter your email");

        return false;

    }


    return true;

}