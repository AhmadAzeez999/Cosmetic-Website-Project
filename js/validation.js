$(document).ready(function () 
{
    $("form").submit(async function (event) 
    {
        // Reset previous error messages
        $(".error-message").text("");

        // Flag to track form validity
        var isValid = true;

        // Name validation
        var name = $("#name").val();
        if (name.trim() === "") 
        {
            $("#nameError").text("Please enter your name.");
            isValid = false;
        }

        // Email validation
        var email = $("#email").val();
        if (!isValidEmail(email)) 
        {
            $("#emailError").text("Please enter a valid email address.");
            isValid = false;
        } else {
            // Check email availability
            var available = await checkEmailAvailability(email);
            if (!available) 
            {
                $("#emailError").text("This email is already in use. Please choose another.");
                isValid = false;
            }
        }

        // Continue with form submission or other validations if needed
        if (isValid) 
        {
            // Password validation
            var password = $("#password").val();
            if (!isValidPassword(password)) 
            {
                $("#passwordError").text("Please enter a valid password (at least 6 characters, one letter, and one number).");
                isValid = false;
            }

            // Password confirmation
            var passwordConfirmation = $("#password_confirmation").val();
            if (password !== passwordConfirmation) 
            {
                $("#passwordConfirmationError").text("Passwords do not match.");
                isValid = false;
            }
        }

        // If any validation fails, prevent the form submission
        if (!isValid) 
        {
            event.preventDefault();
        }
    });

    function isValidEmail(email) 
    {
        // Simple email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPassword(password) 
    {
        // Password should be at least 6 characters and contain one letter and one number
        var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
        return passwordRegex.test(password);
    }

    function checkEmailAvailability(email) 
    {
        var isAvailable = false;
    
        $.ajax(
        {
            url: 'validate-email.php',
            type: 'GET',
            data: { email: email },
            dataType: 'json',
            async: false,  // Synchronous request to wait for the response
            success: function (data) 
            {
                isAvailable = data.available;
            }
        });
    
        return isAvailable;
    }
});
