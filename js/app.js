/**
 * Created by Mbakwe.Caleb on 3/10/2016.
 */
var App = {
    CONSTANTS: {
        map: null,
        data: null,
        url: "data.json",
        center: {
            lat: 6.60416666667,
            long: 3.36611111111
        },
        marker: null,
        infoWindow: null,
        circuit: null
    },
    init: function(){
        this.initMap();
        this.getData();
    },
    getGoogleCords: function(degree, minute, seconds){
        return degree + (minute/60) + (seconds/3600);
    },
    initMap: function(){
        //console.log(App.getGoogleCords(63, 30, 22.1178));
        App.CONSTANTS.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: {
                lat: App.CONSTANTS.center.lat,
                lng: App.CONSTANTS.center.long
            },
            mapTypeId: google.maps.MapTypeId.HYBRID
        });
    },
    getData: function(){
    //    get data from api
        $.getJSON(App.CONSTANTS.url, function(data){
            console.log(data);
            for(var i = 0; i < data.substations.length; i++){
                App.showSubstation(data.substations[i].coord,
                    data.substations[i].data);
                console.log(data.substations[i].circuits);
                for(var j = 0; j < data.substations[i].circuits.length; j++){
                    App.drawCircuit(data.substations[i].circuits[j]);
                }
            }
        });
    },
    showSubstation: function(position, data){
        var labelHTML = '<div><strong>' + data.name + '</strong></div>';
        var path = google.maps.SymbolPath.CIRCLE;

        App.showMarker(position, labelHTML, path, 5);
    },
    showPole: function(position, data){
        var labelHTML = '<div><strong>' + data.name + '</strong></div>';
        var path = google.maps.SymbolPath.BACKWARD_CLOSED_ARROW;

        App.showMarker(position, labelHTML, path, 1);
    },
    drawCircuit: function(circuit){
        App.CONSTANTS.circuit = new google.maps.Polyline({
            path: circuit,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        App.CONSTANTS.circuit.setMap(App.CONSTANTS.map);

        for(var i = 0; i < circuit.length; i++){
            App.showPole(circuit[i], circuit[i].data);
        }
    },
    showMarker: function(position, label, path, scale){
        App.CONSTANTS.marker = new google.maps.Marker({
            position : position,
            icon: {
                path: path,
                scale: scale,
                fillColor: 'yellow',
                strokeColor: 'yellow'
            },
            draggable: false,
            map: App.CONSTANTS.map
        });

        App.CONSTANTS.infoWindow = new google.maps.InfoWindow();
        //var service = new google.maps.places.PlacesService(App.CONSTANTS.map);

        google.maps.event.addListener(App.CONSTANTS.marker, 'click', function() {
            console.log(label);
            App.CONSTANTS.infoWindow.setContent(label);
            App.CONSTANTS.infoWindow.open(App.CONSTANTS.map, this);
        });
    }
};

$(document).ready(function(){
    App.init();
});