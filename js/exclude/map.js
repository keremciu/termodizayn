function initialize() {
  var myLatlng = new google.maps.LatLng(41.088743,28.639738);
  var mapCanvas = document.getElementById("map-canvas");
  var mapOptions = {
    scrollwheel: false,
    center: myLatlng,
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title:"Hello World!"
  });
}
google.maps.event.addDomListener(window, 'load', initialize);