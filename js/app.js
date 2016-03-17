/**
 * Created by Mbakwe.Caleb on 3/10/2016.
 */
var App = {
    CONSTANTS: {
        map: null,
        data: null,
        url: "data.json",
        substationDataURL: "substation_data.json",
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
        //$('.map-data').delegate('body', 'click', function(e){
        //    App.showSubstationData();
        //});
    },
    getGoogleCords: function(degree, minute, seconds){
        return degree + (minute/60) + (seconds/3600);
    },
    initMap: function(){
        //console.log(App.getGoogleCords(63, 30, 22.1178));
        App.CONSTANTS.map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: {
                lat: App.CONSTANTS.center.lat,
                lng: App.CONSTANTS.center.long
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    },
    getData: function(){
    //    get data from api
        $.getJSON(App.CONSTANTS.url, function(data){
            //console.log(data);
            for(var i = 0; i < data.substations.length; i++){
                App.showSubstation(data.substations[i].coord,
                    data.substations[i].data);
                //console.log(data.substations[i].circuits);
                for(var j = 0; j < data.substations[i].circuits.length; j++){
                    App.drawCircuit(data.substations[i].circuits[j]);
                }
            }
        });
    },
    showSubstation: function(position, data){
        var labelHTML = "<div><strong>" + data.name +
            "</strong>&nbsp; <button class='btn btn-xs btn-default' onclick='App.showSubstationData();'>See More...</button><div>";
        //console.log(labelHTML);
        var path = google.maps.SymbolPath.CIRCLE;

        App.showMarker(position, labelHTML, path, 7, "blue");
    },
    showSubstationData: function(){
        $.getJSON(App.CONSTANTS.substationDataURL, function(data){
            console.log(data);
            var HTML = "<div class='table-responsive'><table class='table table-striped table-responsive'>" +
                "<thead><tr>" +
                    "<th>Item</th><th>Manufacturer</th><th>Model Number</th><th>Year</th><th>Fuel Type</th>" +
                    "<th>Country</th><th>Rating</th><th>ISO</th><th>Owner</th>" +
                "</tr></thead><tbody>";
            for(var i = 0; i < data.substation_data.length; i++){
                HTML +=  '<tr><td>' + data.substation_data[i].item + '</td>';
                if(data.substation_data[i].Manufacturer)
                    HTML +=  '<td>' + data.substation_data[i].Manufacturer + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i]['Model Number'])
                    HTML +=  '<td>' + data.substation_data[i]["Model Number"] + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i].Year)
                    HTML +=  '<td>' + data.substation_data[i].Year + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i]["Fuel Type"])
                    HTML +=  '<td>' + data.substation_data[i]["Fuel Type"] + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i].Country)
                    HTML +=  '<td>' + data.substation_data[i].Country + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i].Rating)
                    HTML +=  '<td>' + data.substation_data[i].Rating + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i].ISO)
                    HTML +=  '<td>' + data.substation_data[i].ISO + '</td>';
                else
                    HTML +=  '<td></td>';
                if(data.substation_data[i].Owner)
                    HTML +=  '<td>' + data.substation_data[i].Owner + '</td>';
                else
                    HTML +=  '<td></td>';
                HTML += "</tr>";
            }
            HTML += "</tbody></table></div>";

            $('#substation-data').html(HTML);

            $('#substation-modal').modal('show');
        });
    },
    showPole: function(position, data){
        //console.log(data);
        var labelHTML = '<div>' +
            '<h4>' + data.name + '</h4><hr>' +
            '<p><strong>No of Fittings:</strong> <span>' + data.fittings +
            '</span></p>' +
            '<p><strong>Power Rating:</strong> <span>' +  data.power + '</span></p></div>';
        var path = google.maps.SymbolPath.BACKWARD_CLOSED_ARROW;

        App.showMarker(position, labelHTML, path, 2, 'green');
    },
    drawCircuit: function(circuit){
        //App.CONSTANTS.circuit = new google.maps.Polyline({
        //    path: circuit,
        //    geodesic: true,
        //    strokeColor: '#FF0000',
        //    strokeOpacity: 1.0,
        //    strokeWeight: 2
        //});
        //
        //App.CONSTANTS.circuit.setMap(App.CONSTANTS.map);

        for(var i = 0; i < circuit.length; i++){
            App.showPole(circuit[i], circuit[i].data);
        }
    },
    showMarker: function(position, label, path, scale, color){
        App.CONSTANTS.marker = new google.maps.Marker({
            position : position,
            icon: {
                path: path,
                scale: scale,
                fillColor: color,
                strokeColor: color
            },
            draggable: false,
            map: App.CONSTANTS.map
        });

        App.CONSTANTS.infoWindow = new google.maps.InfoWindow();
        //var service = new google.maps.places.PlacesService(App.CONSTANTS.map);

        google.maps.event.addListener(App.CONSTANTS.marker, 'click', function() {
            //console.log(label);
            App.CONSTANTS.infoWindow.setContent(label);
            App.CONSTANTS.infoWindow.open(App.CONSTANTS.map, this);
        });
    }
};

$(document).ready(function(){
    App.init();
});