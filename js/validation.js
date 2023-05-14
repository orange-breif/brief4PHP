function validateRegistrationForm() {
    var name = document.forms["registrationForm"]["user_fname"].value;
    var username = document.forms["registrationForm"]["user_lname"].value;
    var user_email = document.forms["registrationForm"]["user_email"].value;
    var user_phone = document.forms["registrationForm"]["user_phone"].value;
    var user_img  = document.forms["registrationForm"]["user_img"].value;
    var password = document.forms["registrationForm"]["user_password"].value;
    var confirmpassword = document.forms["registrationForm"]["confirmpassword"].value;
  
    if (name == "") {
      alert("Name must be filled out");
      return false;
    }
  
    if (username == "") {
      alert("Username must be filled out");
      return false;
    }

    if (user_email == "") {
      alert("useremail must be filled out");
      return false;
    }
  
    if (user_phone == "") {
      alert("userphone must be filled out");
      return false;
    }
    if (user_img == "") {
      alert("user_img must be filled out");
      return false;
    }
  
    if (password == "") {
      alert("Password must be filled out");
      return false;
    }
  
    if (confirmpassword == "") {
      alert("Confirm Password must be filled out");
      return false;
    }
  
    if (password.length < 6) {
      alert("Password must be at least 6 characters long.");
      return false;
    }
  
    if (password !== confirmpassword) {
      alert("Passwords do not match.");
      return false;
    }
  
    return true;
  }