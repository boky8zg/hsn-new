<div class="content">
    <div class="header">
        <div class="col col-1">
            <h1>Lokacija</h1>
        </div>
        <div class="col col-2">
            <address>
                <i class="fa fa-map-marker"></i> Ulica Grada Vukovara 68, 10 000 Zagreb
            </address>
        </div>
    </div>

    <div class="main">
        <div id="google-map" data-lat="45.7993583" data-lon="15.9690955" data-zoom="17"></div>

        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            /* Google maps API */
            google.maps.event.addDomListener(window, 'load', function () {
                var LatLon = new google.maps.LatLng($('#google-map').data('lat'), $('#google-map').data('lon'));

                var map = new google.maps.Map(
                    $('#google-map')[0],
                    {
                        center: LatLon,
                        zoom: $('#google-map').data('zoom'),
                        matTypeId: google.maps.MapTypeId.ROADMAP
                    }
                );

                var marker = new google.maps.Marker({
                    position: LatLon,
                    map: map,
                    title: 'Hrvatska Sveučilišna Naklada'
                });
            });
        </script>
    </div>
</div>