@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&libraries=places,geometry"></script>
    <script>
        const latitude = $('#latitude');
        const longitude = $('#longitude');
        const placeID = $('#placeID');
        const mapBtn = $('#mapBtn');
        const mapModal = $('#mapModal');
        const mapModalTitle = $('#mapModalTitle');

        const locationInput = document.getElementById('locationInput');

        let map, marker, autocomplete;

        autocomplete = new google.maps.places.Autocomplete(locationInput, {
            types: ['geocode']
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function(){
            var near_place = autocomplete.getPlace();
            latitude.val(near_place.geometry.location.lat());
            longitude.val(near_place.geometry.location.lng());
            placeID.val(near_place.place_id);
        });

        mapBtn.on('click', function(e){
            e.preventDefault();
            mapModal.modal();
            initMap();
        });

        function initMap(){
            var location = new google.maps.LatLng(latitude.val(), longitude.val());
            var mapProperty = {
                center: location,
                zoom: 17,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map'), mapProperty);
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: location
            });

            geocodePosition(marker.getPosition());

            google.maps.event.addListener(marker, 'dragend', function(){
                map.setCenter(marker.getPosition());
                geocodePosition(marker.getPosition());
            })

        }

        function geocodePosition(pos){
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                    latLng: pos
                }, function(result, status){
                    if(status === google.maps.GeocoderStatus.OK){
                        mapModalTitle.html(result[0].formatted_address);
                        $('#locationInput').val(result[0].formatted_address);
                        placeID.val(result[0].place_id);
                        latitude.val(result[0].geometry.location.lat());
                        longitude.val(result[0].geometry.location.lng());
                    } else {}
                }
            )
        }
    </script>
    @endsection

@section('style')
    <style>
        #map {
            width: 100%;
            height: 480px;
        }
    </style>
    @endsection



{{--<iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d15852.209799547683!2d3.348024608807929!3d6.640409243664999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m3!3m2!1d6.6419368!2d3.3469549!4m5!1s0x103b938f470a7603%3A0x366b86e68e7425b4!2sEreke%20Avenue%2C%20Ojodu%2C%20Ojodu%20Berger%2C%20Nigeria!3m2!1d6.6464944!2d3.3681799999999997!5e0!3m2!1sen!2sng!4v1689355099784!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
