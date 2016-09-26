//The following js code is adapted from Google place api
// reference: https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


var nearbyService;
var newLocation;
var map;
var address;
var requestForNearbyFacility;
var autocomplete;
var infowindow;
var marker;
var markerArray=[];
var detailService;


function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:  -37.882914, lng: 145.02282},
        zoom: 13
    });

    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('venue_addr'));
    //var searchBounds = new google.maps.LatLngBounds(
    //    new google.maps.LatLng(-44, 113),
    //    new google.maps.LatLng(-10, 154));

    //initialize marker
    marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
        clickable: true,
        animation:google.maps.Animation.DROP,
        icon:'http://www.googlemapsmarkers.com/v1/A/0099FF/FFFFFF/FF0000/',
        zIndex: google.maps.Marker.MAX_ZINDEX + 1
    });
    detailService = new google.maps.places.PlacesService(map);
    autocomplete = new google.maps.places.Autocomplete(input,{componentRestrictions: {'country':'au'}});
    autocomplete.bindTo('bounds', map);



    //marker.setVisible(true);


    autocomplete.addListener('place_changed',placeChanged);
    //google.maps.event.addListener(marker, 'click', function() {
    //    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    //    infowindow.open(map, marker);
    //
    //});

}
function placeChanged(){
    infowindow = new google.maps.InfoWindow();
    infowindow.close();

    var place = autocomplete.getPlace();
    if (!place.geometry) {
        //window.alert("Opps! Please type in a valid address in Australia!");
        document.getElementById('mismatchedLocation').text("Opps! Please type in a valid address in Australia!");
        return;
    }

    //clear marker
    removeMarker(markerArray);

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(15);
    }
    newLocation = place.geometry.location;
    marker.setVisible(true);

    marker.setPosition(newLocation);

    var infocontent = setWindowInfo(place);
    infowindow.setContent(infocontent );


    addMarkerListener(marker,infowindow);

    //send the address to venue address field
    document.getElementById('venue_addr').value= place.formatted_address;
    document.getElementById('hiddenLocation').value= place.formatted_address;


    searchNearby();
}


function searchNearby(){
    //search nearby facility
    requestForNearbyFacility={
        location: newLocation,
        radius:'200',
        types:['city_hall','library','university','cafe']//|'library'|'university'
    }
    nearbyService = new google.maps.places.PlacesService(map);
    nearbyService.nearbySearch(requestForNearbyFacility,nearbycallback);
}

//search nearby facilities call back function
function nearbycallback(results,status){
    if(status===google.maps.places.PlacesServiceStatus.OK){
        for(var i=0;i<results.length;i++){

            getDetailFromPlaceId(results[i].place_id);
           //var marker= createMarker(results[i]);
           // markerArray[i]=marker;
        }
    }
}

//google detail service--get detail from place id

function getDetailFromPlaceId(placeID){


    detailService.getDetails({placeId:placeID},function(result, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var marker= createMarker(result);
            markerArray.push(marker);
        }
    });
}

//function detailCallback(place,status){
//    if (status == google.maps.places.PlacesServiceStatus.OK) {
//
//        var marker= createMarker(place);
//        markerArray[i]=marker;
//    }
//
//}

//create marker function
function createMarker(nearbyPlaceSearched){
    //var photos = place.photos;
    //if(!photos){
    //    return;
    //}

    //var addr = getAddressOfPlace(placeSearched);
    var placeLoc = nearbyPlaceSearched.geometry.location;
    var icon = {

    }
    var image = setIconImage(nearbyPlaceSearched);
    var markerNearby = new google.maps.Marker({
        map:map,
        position: placeLoc,
        icon:image,
        //icon:photos[0].getUrl({'maxWidth':35,'maxHeight':35}),
        animation:google.maps.Animation.DROP
    });


    var infowindowForNearbyFacility = new google.maps.InfoWindow();
    var infoContent = setWindowInfo(nearbyPlaceSearched);
    //infowindowForNearbyFacility.close();
    //infowindowForNearbyFacility.setContent('<div><strong>' + nearbyPlaceSearched.name + '</strong><br>'+"<div>"+nearbyPlaceSearched.formatted_address+"</div>"+
    //    "<div>Contact:"+phoneNum+"</div>" +
    //    "<div> Opening hours: "+openhour +" - "+closehour+"</div>"+
    //  "<div>Website:"+website+"</div>");
    infowindowForNearbyFacility.setContent(infoContent);

    addMarkerListener(markerNearby,infowindowForNearbyFacility);
    return markerNearby;

}

//set window infor
function setWindowInfo(placeToSet){
    var openhour;

    var website;

    var phoneNum;
    var name;
    var address;

    name=placeToSet.name;
    address=placeToSet.formatted_address;



    try{
        openhour = placeToSet.opening_hours.periods[1].open.time +"-"+placeToSet.opening_hours.periods[1].close.time;

    }
    catch(e){
        openhour='No opening and close hour available!';

    }


    try{
        website = placeToSet.website;
    }
    catch(e){
        website='No website available!';
    }

    try{
        phoneNum = placeToSet.international_phone_number;
    }
    catch(e){
        phoneNum='No phone number is available!';
    }

    var infocontent = '<div><strong>' + name + '</strong><br>'+"<div>"+address+"</div>"+
        "<div>Contact:"+phoneNum+"</div>" +
        "<div> Opening hours: "+openhour + "</div>"+
        "<div>Website:"+website+"</div>";

    return infocontent;

}


//set icon image
function setIconImage(placeSearched){
    var image={
        url: placeSearched.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(30, 30)
    }
    return image;
}

//add listener to each marker
function addMarkerListener(marker,infowin){
    marker.addListener('mouseover', function(){

        infowin.open(map, this);
    });

    marker.addListener('click',function(){
        this.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
    });

    //when you move your mouse out of the marker it shows the information you want to show
    marker.addListener('mouseout', function(){
        infowin.close(map, this);
    });
}

//clear marker
function removeMarker(markers){
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}






