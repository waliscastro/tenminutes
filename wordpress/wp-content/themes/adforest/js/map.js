/* NOTES: this demo adds a couple of niceties: dismissing the InfoWindow when we click another marker or the map, and different formatting for markers that will spiderfy when clicked for efficiency, we use a single formatting listener on the spiderfier instance — rather than one per marker — since all markers are otherwise displayed the same oms.addMarker(marker, function(e) { / * handle stuff * / }); -- is precisely equivalent to -- marker.setMap(map); oms.trackMarker(marker); gm.event.addListener(marker, 'spider_click', function(e) { / * handle stuff * / });*/
var isIE = false;
var map = null;
var circle = null;
var geocoder = new google.maps.Geocoder();
var check_rand = 0;
var max_zoom = 10;
var min_zoom = 11;
var iw = new google.maps.InfoWindow();
(function ($) {
    "use strict";
    var markerImage = new google.maps.MarkerImage(imageUrl, new google.maps.Size(50, 77));
    var marker = new google.maps.Marker({ 'icon': markerImage, 'optimized': false });
    var mapLibsReady = 0;
    function mainMap() {
        var mapZoomAttr = $('#map').attr('data-map-zoom');
        var mapScrollAttr = $('#map').attr('data-map-scroll');
        if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
            var zoomLevel = parseInt(mapZoomAttr);
        } else {
            var zoomLevel = search_map_zoom;
        }
        if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
            var scrollEnabled = parseInt(mapScrollAttr);
        } else {
            var scrollEnabled = false;
        }
        var currentInfobox;

        var ad_country = adforest_getUrlVars()['ad_country'];
        var country_id = adforest_getUrlVars()['country_id'];
        var cat_id = adforest_getUrlVars()['cat_id'];
        var ad_title = adforest_getUrlVars()['ad_title'];
        var loc_vars = false;
        loc_vars = typeof ad_country !== 'undefined' && ad_country != '' ? true : loc_vars;
        loc_vars = typeof country_id !== 'undefined' && country_id != '' ? true : loc_vars;
        loc_vars = typeof cat_id !== 'undefined' && cat_id != '' ? true : loc_vars;
        loc_vars = typeof ad_title !== 'undefined' && ad_title != '' ? true : loc_vars;

        if (loc_vars && typeof locations !== 'undefined' && locations != '') {
            search_map_lat = locations[0][1];
            search_map_long = locations[0][2];
        }
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: zoomLevel,
            scrollwheel: scrollEnabled,
            center: new google.maps.LatLng(search_map_lat, search_map_long),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{"featureType": "administrative.land_parcel", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "landscape.man_made", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "poi", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "simplified"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"hue": "#f49935"}]}, {"featureType": "road.highway", "elementType": "labels", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"hue": "#fad959"}]}, {"featureType": "road.arterial", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.local", "elementType": "labels", "stylers": [{"visibility": "simplified"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"hue": "#a1cdfc"}, {"saturation": 30}, {"lightness": 49}]}]
        });
        function iwClose() { iw.close(); }
        google.maps.event.addListener(map, 'click', iwClose);
        var oms = new OverlappingMarkerSpiderfier(map, {markersWontMove: true, markersWontHide: true});
        oms.addListener('format', function (marker, status) {
            var iconURL = status == OverlappingMarkerSpiderfier.markerStatus.SPIDERFIED ? imageUrl :
                    status == OverlappingMarkerSpiderfier.markerStatus.SPIDERFIABLE ? imageUrl_more :
                    status == OverlappingMarkerSpiderfier.markerStatus.UNSPIDERFIABLE ? imageUrl :
                    null;
            var iconSize = new google.maps.Size(24, 38);
            marker.setIcon({ url: iconURL, size: iconSize, scaledSize: iconSize });
        });

        var boxText = document.createElement("div");
        boxText.className = 'grid-style-2'
        var currentInfobox;
        var boxOptions = { content: boxText, disableAutoPan: true, alignBottom: true, maxWidth: 0, pixelOffset: new google.maps.Size(-60, -55), zIndex: null, boxStyle: {  width: "240px" }, closeBoxMargin: "0", closeBoxURL: close_url, infoBoxClearance: new google.maps.Size(1, 1), isHidden: false, pane: "floatPane", enableEventPropagation: false, };
        var markerCluster, marker, i;
        var allMarkers = [];
        var clusterStyles = [{ textColor: 'white', url: '', height: 50, width: 50 }];

        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);
        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "custom-zoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "custom-zoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                map.setZoom(map.getZoom() - 1);
            });
        }
        var allMarkers = [];
        for (var i = 0, len = locations.length; i < len; i++) {
            (function () {  // make a closure over the marker and marker data

                /*console.log(locations[i][1]);*/
                var markerData = {lat: parseFloat(locations[i][1]), lng: parseFloat(locations[i][2]), text: locations[i][0]};  // e.g. { lat: 50.123, lng: 0.123, text: 'XYZ' }
                var marker = new google.maps.Marker({
                    position: markerData,
                    id: i,
                    animation: google.maps.Animation.DROP,
                    optimized: !isIE  // makes SVG icons work in IE
                });
                allMarkers.push(marker);
                google.maps.event.addListener(marker, 'click', iwClose);
                oms.addMarker(marker, function (e) {
                    iw.setContent('<div style="overflow:hidden; height:100px; width:300px;">' + markerData.text + '</div>');
                    iw.open(map, marker);
                });
            })();
        }
        if (show_radius != "")
        {
            google.maps.event.addListenerOnce(map, 'tilesloaded', radius_search);
        }
        $('#nextpoint').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            var index = currentInfobox;
            alert(allMarkers[index + 1]);
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index + 1], 'click');
            } else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }
        });
        $('#prevpoint').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            if (typeof (currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            } else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            map.setOptions({
                draggable: true
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', mainMap);
})(this.jQuery);

jQuery(document).ready(function ($) {
    $("#reset_state").click(function () {
        console.log(map);
        map.setCenter(new google.maps.LatLng(search_map_lat, search_map_long));
        map.setZoom(search_map_zoom);
    });
    /*You current location */
    $("#you_current_location").click(function () {
        $.ajax({
            url: "https://geolocation-db.com/jsonp",
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function (location) {
                /*$('#country').html(location.country_name); $('#state').html(location.state); $('#city').html(location.city); $('#latitude').html(location.latitude); $('#longitude').html(location.longitude); $('#ip').html(location.IPv4);*/
                var pos = new google.maps.LatLng(location.latitude, location.longitude);
                map.setCenter(pos);
                map.setZoom(search_map_zoom);
            }
        });
    });

});

function radius_search()
{
    var address = document.getElementById('sb_user_address').value;
    var km = document.getElementById('map_radius').value;
    var radiud_search_type = jQuery('#adforest_radius_type').val();
    if (typeof radiud_search_type !== 'undefined' && radiud_search_type == 'mile') {
        km = km * 1.609344;  // convert kilometer to miles 
    }
    var radius = parseInt(km, 10) * 1000;
    /*var radius = parseInt(25, 10)*1000;*/
    if (address != "" && km != "")
    {
        jQuery('#sb_loading').show();
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                circle_zoom = 10;
                if (km <= 6)
                    circle_zoom = 12;
                else if (km > 6 && km <= 12)
                    circle_zoom = 11;
                else if (km > 30)
                    circle_zoom = 9;

                map.setZoom(circle_zoom);
                var searchCenter = results[0].geometry.location;

                if (circle)
                    circle.setMap(null);
                circle = new google.maps.Circle({center: searchCenter, radius: radius, strokeColor: "#f58936", strokeOpacity: 0.8, fillOpacity: 0.25, fillColor: "#696969", map: map });
                jQuery('#sb_loading').hide();

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
}

function adforest_getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}