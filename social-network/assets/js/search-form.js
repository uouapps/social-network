function submitSearchForm() {
		var select_dir_type= jQuery( "#dir_type option:selected" ).val();


		var submit_url_doctor =jsdata.doctor_url;
		var submit_url_hospital =jsdata.hospital_url;


		var action_archive_url='';
		if(select_dir_type=='doctor'){
			action_archive_url= submit_url_doctor;
		}
		if(select_dir_type=='hospital'){
			action_archive_url= submit_url_hospital;
		}


		jQuery('#searchformhd').attr('action', action_archive_url).submit();


}
function initialize_address() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
			google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //document.getElementById('city2').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }
google.maps.event.addDomListener(window, 'load', initialize_address);
