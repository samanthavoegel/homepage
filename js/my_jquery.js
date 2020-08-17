$(document).ready(function(){
	 $('#topnav a').each(function(hans, elementinhalt) { 
		 					console.log(window.location);
	   if (elementinhalt.href == location.href) { /* wenn der Link den ich gerade durchlaufe, gleich dem is, welcher in der Adresszeile ist, dem weise ich die Klasse akt zu */
//wenn href des in der Schleife durchlaufenden a-Tags == der aktuellen Adresse (in der Adresszeile)
         	$(elementinhalt).addClass('akt');
			//$('h1').text(elementinhalt);
        }
     });
});
	  
//  elementinhalt und location sind objekte die methode href liefert bei beiden die komplette Adresse
//		console.log(window.location.toString());	//id des Elementes			

//  zahl ist die id (zählt die elemente durch mi 0 beginnend)
//  elentinhalt ist bei a der Linktext / elentinhalt.href zeigt den vollst. ref. Link vollständig

// nur eine Spielerei ... window.location.pathname gibt das gleiche Ergebnis wie window.location.toString()
//		 var pagePathName= window.location.pathname;
//		 pagePathName =pagePathName.substring(pagePathName.lastIndexOf("/") + 1); 
//		 $('h1').text(pagePathName);
