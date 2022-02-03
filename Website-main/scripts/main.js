
					/* Products pages */

	/* Change main image in div-description when an image in the list is clicked on */

//Get main image
let myImage = document.querySelector(".img-selected")

//Get all the images on the list
let images =  document.querySelectorAll(".sidebar img")

//addEvent listener on click for each image in images
for (let i = 0; i < images.length; i++){
	images[i].addEventListener("click", function(){
		let mySrc = images[i].getAttribute("src")			//Get src of the image when clicked on
		myImage.setAttribute("src", mySrc)					//Set main image src with the one got before
	})
	
}



	/* Zoom on main image */

img = document.querySelector(".img-selected")				//Get the main image 

// Function to increase image size 
function enlargeImg() { 
	 
	//If the image has alreaby been scaled => set original size
	if (img.style.transform === "scale(1.5)"){
		img.style.transform = "scale(1)"; 					// Set image size to original 
		img.style.transition = "transform 0.25s ease"; 		// Animation effect 
	}

	//Else => set image scaled
	else{
		img.style.transform = "scale(1.5)";					// Set image size to 1.5 times original 
		img.style.transition = "transform 0.25s ease";		// Animation effect   
	}	
} 



	/* Set visibility stock */

buttonStock = document.querySelector(".button-stock")		//Get button stock

//Set the visiblity when stock button is clicked
buttonStock.addEventListener("click", function(){
	stock = document.querySelector(".p-stock")				//Get the stock paragraph

	//If it's already hidden => set visible
	if (stock.style.visibility === "hidden" || stock.style.visibility === "")
		stock.style.visibility = "visible"
	
	//If it's visible => set hidden
	else 		
		stock.style.visibility = "hidden"
})



	/* Add to cart */

buttonCart = document.querySelector(".button-cart")			//Get the button cart

//Set the visibility of the quantity div
buttonCart.addEventListener("click", function(){
	form = document.querySelector(".form-quantity")			//Get form
	quantity = document.querySelector(".p-cartQuantity")	//Get quantity
	stock = document.querySelector(".p-stock")				//Get the stock paragraph

	let int_stock = parseInt(stock.textContent)				//cast stock to int

	//When is clicked and Quantity is hidden, shows 1 if stock >= 1
	if (form.style.visibility === "hidden" || form.style.visibility === "" && int_stock > 0)
	{
		/* Add to cart => display Quantity: 1  - + */
		form.style.visibility = "visible"
		quantity.value = 1
	}

	//Else, stock = 0 or quantity is visible	
	else {
		//If stock = 0, display an error message
		if (int_stock === 0){
			stock.style.visibility = "visible"
			alert("Error, article isn't available. Try again later")
		}
		
		//Else, the quantity is visible => hide it and reset quantity value
		else{
			form.style.visibility = "hidden"
			quantity.value = 0				
		}
	}
})


	//////////////////// Add more or less to cart \\\\\\\\\\\\\\\\\\\\									


/* Since we're here, the "add to cart" button has already been clicked on */
pCartQuantity = document.querySelector(".p-cartQuantity");
pCartQuantity.addEventListener("click", function(){
	form = document.querySelector(".form-quantity")			//Get form
	stock = document.querySelector(".p-stock")				//Get the stock paragraph

	if (pCartQuantity.value == 0)
		form.style.visibility = "hidden"
	if (pCartQuantity.value == pCartQuantity.getAttribute('max'))
		stock.style.visibility = "visible"
	if (stock.style.visibility === "visible" && pCartQuantity.value < pCartQuantity.getAttribute('max'))
		stock.style.visibility = "hidden"
})






	