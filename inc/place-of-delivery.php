<?php
require 'db.php';
session_start();

if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Devi avere eseguito l'accesso per vedere questa pagina!";
  header("location: error.php");    
}

if(empty($_SESSION['cart'])){
	header("location: categories.php");   
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/head.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/header.php';
?>
<h1>Seleziona il luogo di consegna</h1>
<p class="under_title">Inserisci un indirizzo di Cesena valido</p>
<div id="locationField">
      <form action="payment.php" id="location" method="post"><input id="autocomplete" name="place" placeholder="Scrivi l'indirizzo di consegna"
             onFocus="geolocate()" type="text"></input></form>
	<div><button type="button" onclick="check()">Effettua il pagamento</button></div>
</div>

    
       <script>

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {

        var options = {
  	types: ['geocode'],
  	componentRestrictions: {country: "IT"}
	 };
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),options);
        autocomplete.addListener('place_changed', fillInAddress);

      }

      function fillInAddress() {
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
		var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
		
           
          }
        }
      }

	function check()
	{
	  var CE = " Cesena";
	  var output = document.getElementById('autocomplete').value;
	  var city = output.split(',',3);
	
	  if(city[2] != CE)	
		document.getElementById('autocomplete').style.borderColor = "#f4425c";
	  else
	  {
		  document.getElementById('location').submit();
	  }

}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWgYEGqFxbfE5JAlU8NuC6DtrlqzZ5oDY&libraries=places&callback=initAutocomplete"
        async defer></script>
	  
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/Progetto/inc/footer.php'; ?>