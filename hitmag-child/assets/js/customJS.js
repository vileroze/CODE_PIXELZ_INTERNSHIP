


function validateForm() {
    
    let u_full_name = document.forms["userInfoForm"]["full_name"].value;
    let u_email = document.forms["userInfoForm"]["user_email"].value;
    let u_bio = document.forms["userInfoForm"]["bio"].value;
    let u_location = document.forms["userInfoForm"]["location"].value;
    let u_profile_img = document.forms["userInfoForm"]["profile_img"].value;

    if (u_full_name === "" ||  u_bio === "" || u_location === "") {
        alert("All fields must be filled out !!");
        return false;
    }

    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(u_email)) || u_email === ""){
        alert("Invalid email provided !!");
        return false;
    }

    if( u_profile_img === "" ){
        alert("Please choose a profile image !!");
        return false;
    }

    return true;
}