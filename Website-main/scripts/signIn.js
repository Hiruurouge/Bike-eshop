/* Sign in page */


/* If a least one field is empty, an error message is displayed, hide it when line edit are clicked on */
let emailLine = document.getElementById("email")			//Get email line edit
let passLine = document.getElementById("password")			//Get password line edit
let pEmptyFields = document.querySelector(".p-emptyFields")	//Get the paragraph error

if (emailLine !== null && pEmptyFields !== null){
		/* When one line edit is clicekd on (will be modified), hide the error message */
	emailLine.addEventListener("click", function() {
		if (pEmptyFields !== null)
			pEmptyFields.style.visibility = "hidden"
	})

	if (passLine !== null){
		passLine.addEventListener("click", function() {
			if (pEmptyFields !== null)
				pEmptyFields.style.visibility = "hidden"
		})
	}
	
}