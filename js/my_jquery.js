$(document).ready(function(){
	 $('#topnav a').each(function(hans, elementinhalt) { 
		 					console.log(window.location);
	   if (elementinhalt.href == location.href) {
         	$(elementinhalt).addClass('akt');
        }
     });
});
