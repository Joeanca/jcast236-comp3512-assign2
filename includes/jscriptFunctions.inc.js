function setLatLong(lat, long) {
            this.lat= lat;
            this.long= long;
}

function initMap() {
            var uluru = {lat: this.lat, lng: this.long};
            var map = new google.maps.Map(document.getElementById('map'), { 
            zoom: 14, center: uluru});
            var marker = new google.maps.Marker({
            position: uluru, map: map});
}
