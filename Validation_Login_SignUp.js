
const form = document.getElementById('form')
const Username_input = document.getElementById('Username-input')
const PhoneNumer_input = document.getElementById('PhoneNumber-input')
const Email_input = document.getElementById('Email-input')
const Password_input = document.getElementById('Password-input')
const RepeatPassword_input = document.getElementById('Repeat-Password-input')
const error_message = document.getElementById('error message');


form.addEventListener('submit', (e) =>{
    //e.preventDefault()

    let errors = []

    if(Email_input){
        //if we have a Email input then we are at the Sign Up page
        errors = getSignupFromErrors(Username_input.value, PhoneNumer_input.value, Email_input.value, Password_input.value, RepeatPassword_input.value)
    }
    else{
        //if we dont have a Email input then we are at the login page
        errors = getLoginFormErrors(Username_input.value, Password_input.value)
    }

    if(errors.length > 0){
        //if there is any error in the array
        e.preventDefault()
        error_message.innerText = errors.join(". ")
    }
})

function getSignupFromErrors(Username,PhoneNumber,Email,Password,RepeatPassword){
    let errors = []
    
    if(Username === '' || Username == null){
        errors.push('Username is required')
        Username_input.parentElement.classList.add('incorrect')
    }
    if(PhoneNumber === '' || PhoneNumber == null){
        errors.push('Phone Number is required')
        PhoneNumer_input.parentElement.classList.add('incorrect')
    }
    if(Email === '' || Email == null){
        errors.push('Email is required')
        Email_input.parentElement.classList.add('incorrect')
    }
    if(Password === '' || Password == null){
        errors.push('Password is required')
        Password_input.parentElement.classList.add('incorrect')
    }
    if(Password.length < 8 && Password != ''){
        errors.push('password must have at least 8 characters')
        Password_input.parentElement.classList.add('incorrect')
    }
    if(RepeatPassword === '' || RepeatPassword == null){
        errors.push('Re-enter password is required')
        RepeatPassword_input.parentElement.classList.add('incorrect')
    }
    if(RepeatPassword !== Password){
        errors.push('Password does not match please re-enter')
        Password_input.parentElement.classList.add('incorrect')
        RepeatPassword_input.parentElement.classList.add('incorrect')
    }

    return errors;
}

function getLoginFormErrors(Username,Password){
    let errors = []
    
    if(Username === '' || Username == null){
        errors.push('Please enter a valid Username')
        Username_input.parentElement.classList.add('incorrect')
    }
    if(Password === '' || Password == null){
        errors.push('Please enter a valid Password')
        Password_input.parentElement.classList.add('incorrect')
    }

    return errors;
}

let clickCount = 0; // Initialize the click counter
const logoLink = document.getElementById('logo-link'); // Reference the logo link element

if (logoLink) {
    logoLink.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default navigation

        clickCount++; // Increment the click counter

        // Debug: Log the click count in the console
        console.log(`Logo clicked ${clickCount} times.`);

        // Redirect after 7 clicks
        if (clickCount > 7) {
            window.location.href = "Admin_Login.php";
        }
    });
} else {
    console.error("Element with ID 'logo-link' not found.");
}


const allInputs = [Username_input, PhoneNumer_input, Email_input, Password_input, RepeatPassword_input].filter(input => input != null)

allInputs.forEach(input => {
    input.addEventListener('input', () => {
        if(input.parentElement.classList.contains('incorrect')){
            input.parentElement.classList.remove('incorrect')
            error_message.innerText = ''
        }
    })
})

function togglePassword(fieldId, iconElement) {
    const passwordField = document.getElementById(fieldId);
    const icon = iconElement.querySelector("i");
  
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
