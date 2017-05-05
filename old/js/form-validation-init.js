/**
 * Created by mosaddek on 3/8/15.
 */

var Script = function () {

    

    $().ready(function() {
       
		
        // validate signup form on keyup and submit
        $("#newUser").validate({
            rules: {
                name: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                
                email: {
                    required: true,
                    email: true
                },
				nik: {
                    required: true,
                    maxlength: 6,
					number: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
				departemen: { 
					required: true
				},
				distrik: { 
					required: true
				}
				,
				atasan: { 
					required: true
				}
            },
            messages: {
                name: "Please enter your name",
                username: {
                    required: "Please enter an username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
				nik: {
                    required: "Please enter a NIK",
                    maxlength: "Your NIK maximum 6 characters long",
					number: "NIK must number"
                },
                
                email: "Please enter a valid email address",
				departemen: { 
					required: "Please select department" 
				},
				distrik: { 
					required: "Please select district" 
				},
				atasan: { 
					required: "Please select responsible to" 
				}
				
            }
        });
		$("#changePass").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
				
            }
        });
		$("#changePass2").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
				new_password: {
                    required: true,
                    minlength: 5
                },
				confirm_pass: {
                    required: true,
                    minlength: 5,
                    equalTo: "#new_password"
                }
            },
            messages: {
                password: {
                    required: "Please provide an old password",
                    minlength: "Your old password must be at least 5 characters long"
                },
				new_password: {
                    required: "Please provide a new password",
                    minlength: "Your new password must be at least 5 characters long"
                },
				confirm_pass: {
                    required: "Please confirm new password",
                    minlength: "Confirm password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                }
				
            }
        });

        
    });


}();
