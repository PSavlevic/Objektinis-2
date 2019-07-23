let messageBox = document.querySelector('.message');

if (messageBox) {
	setTimeout ( function() { 
		$ (".message").fadeOut("slow");
	}, 1000);
}