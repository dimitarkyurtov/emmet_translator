var clickHandler = function(event) {

    var username = document.forms["form"]["username"].value;
    var password = document.forms["form"]["password"].value;
    var password_2 = document.forms["form"]["password_2"].value;
    var name = document.forms["form"]["name"].value;

    console.log(username);
    console.log(password);
    console.log(password_2);
    console.log(name);

    var errors = [];
    if(username.length < 3){
        errors.push("Username length must be more than 3!");
    }
    if(username.length > 30){
        errors.push("Username length must be less than 30!");
    }
    if(!/^[a-zA-Z_]+$/.test(username)){
        errors.push("Username should contain only letters and _ !");
    }
               
    if(password.length < 6){
        errors.push("Password length must be atleast 6!");
    }
    if(!/[1-9]/.test(password)){
        errors.push("Password should contain a number!");
    }
    if(password.toUpperCase() == password){
        errors.push("Password should contain a lowercase character!");
    }
    if(password.toLowerCase() == password){
        errors.push("Password should contain an uppercase character!");
    }
    if(password != password_2){
        errors.push("Password should match!");
    }
    if(username.length < 2){
        errors.push("Name length must be more than 2!");
    }
    if(name.length > 15){
        errors.push("Name length must be less than 15!");
    }
    if(errors.length > 0){
        document.getElementById('error').textContent = "";

        for(let index = 0; index < errors.length && index < 3; index++)
        {
            var tag = document.createElement("p");
            var text = document.createTextNode(errors[index]);
            tag.appendChild(text);
            var element = document.getElementById("error");
            element.appendChild(tag);
        }
        return false;
    }else{
        return true;   
    } 
};