function checkValidInput(input) {
    if (/^\s/.test(input.value))
        input.value = '';
}
function isNumber(t) {
    // Remove non-digit characters
    t.value = t.value.replace(/\D/g, '');

    // Limit the input to 10 characters
    if (t.value.length > 10) {
        t.value = t.value.slice(0, 10);
    }
}

/*$("#inquiry-form").validate({
    rules: {
        first_name: {
            required: true,
            minlength: 2
        },
        last_name: {
            minlength: 2
        },
        phone_number:{
            required: true,
            number:true,
            minlength:10,
            maxlength:10
        },
        email: {
            required:true,
            email: true
        },
        accept_terms:{
            required:true
        }
    },
    messages: {
        first_name: {
            required: "Please enter your first name",
            minlength: "Please enter first name greater than 2 characters"
        },
        last_name: {
            minlength: "Please enter last name greater than 2 characters"
        },
        phone_number:{
            required: "Please enter your phone number",
            number:"Phone number must be numeric",
            minlength:"Phone number must be equal to 10 digits",
            maxlength:"Phone number must be equal to 10 digits"
        },
        email: {
            required: "Please enter your email",
            email: "Please enter valid email"
        },
        accept_terms:{
            required:true
        }
    },
    submitHandler: function (form) {
        form.submit()
    }
});*/
