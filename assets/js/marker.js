function initMap() {
    const locations = [
        { lat: -34.397, lng: 150.644, title: "Location 1" },
        { lat: -35.307, lng: 149.124, title: "Location 2" }
    ];

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        center: locations[0], // Center the map on the first location
    });

    locations.forEach(location => {
        new google.maps.Marker({
            position: location,
            map: map,
            title: location.title,
        });
    });
}
