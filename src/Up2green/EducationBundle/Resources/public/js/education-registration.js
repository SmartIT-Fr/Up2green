$(function() {
    var ajax;
    var mapOptions = {
        center      : new google.maps.LatLng(46.227638, 2.213749),
        zoom        : 5,
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("googlemap"), mapOptions);;

    // When a Change event is sent by address textarea
    // Call webservice to know geolocalization from the address
    // And with lat and long refresh iframe to show a preview of the address
    // Idea for futur : Populate with other school address and let people click on it
    $('#education_registration_school_new_address').keyup(function() {
        if (null != ajax) {
            ajax.abort();
        }

        ajax = $.ajax({
            url: Routing.generate('education.registration.geoloc', {'domain': app.domain}),
            data: {
                address: $(this).val()
            },
            dataType: 'json',
            success: function(data) {
                map.setCenter(new google.maps.LatLng(data.latitude, data.longitude));
                if (null !== data.streetName) {
                    map.setZoom(17);
                } else {
                    map.setZoom(11);
                }
            }
        });
    });

    if ($('#education_registration_school_choice_0').is(":checked")) {
        $('#education_registration_school_new_control_group').hide();
    } else {
        $('#education_registration_school_existing_control_group').hide();
        $('#education_registration_school_new_address').keyup();
    }

    $('#education_registration_school_choice_0').click(function() {
        $('#education_registration_school_existing_control_group').show();
        $('#education_registration_school_new_control_group').hide();
    });

    $('#education_registration_school_choice_1').click(function() {
        $('#education_registration_school_new_control_group').show();
        $('#education_registration_school_existing_control_group').hide();
    });
});