$('.image_radio').change(function(){
	console.log('radio button choosen');
	val	=	$('.image_radio:checked').val();
	
	$(".output").attr("src","http://placehold.it/540x480?text=loading+image/");
	$(".output").attr("src","gif/source/"+val+".gif");
});

$('#input_text').keyup(function(){
	console.log('typing started...');
	txt_val	=	$('#input_text').val();
	if(txt_val.length>70){
		alert('Maximum character length should be 60 character');
	}
	$('.preview_text').html(txt_val);
});



$(document).ready(function(){
				$('#loading').hide();
			$('#form').submit(function(){
				$('#loading').show();
			});
			});


// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}