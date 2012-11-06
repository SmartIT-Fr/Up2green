$(function() {
    var ajax;
    var mapOptions = {
        center      : new google.maps.LatLng(46.227638, 2.213749),
        zoom        : 5,
        mapTypeId   : google.maps.MapTypeId.ROADMAP
    };
    var map;

    function showCreationSchool() {
        $('#education_registration_school_name_control_group').show();
        $('#education_registration_school_address_control_group').show();
    }

    function hideCreationSchool() {
        $('#education_registration_school_name_control_group').hide();
        $('#education_registration_school_address_control_group').hide();
    }

    function showSelectSchool() {
        $('#education_registration_school_schoolList_control_group').show();
    }

    function hideSelectSchool() {
        $('#education_registration_school_schoolList_control_group').hide();
    }

    hideSelectSchool();
    hideCreationSchool();

    $('#education_registration_school_school_0').click(function() {
        showSelectSchool();
        hideCreationSchool();
    });

    $('#education_registration_school_school_1').click(function() {
        showCreationSchool();
        hideSelectSchool();

        if (null == map) {
            map = new google.maps.Map(document.getElementById("googlemap"), mapOptions);
        }
    });

    // When a Change event is sent by address textarea
    // Call webservice to know geolocalization from the address
    // And with lat and long refresh iframe to show a preview of the address
    // Idea for futur : Populate with other school address and let people click on it
    $('#education_registration_school_address').keyup(function() {
        if (null != ajax) {
            ajax.abort();
        }
        ajax = $.ajax({
            url: Routing.generate('education.registration.geoloc'),
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
});