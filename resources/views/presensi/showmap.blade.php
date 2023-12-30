<style>
    #map {
        height: 250px;
    }
</style>
<div id="map"></div>
<script>
    var lokasi = "{{ $presensi->lokasi_in }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];
    var map = L.map('map').setView([latitude, longitude], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    //lokasi kantor
    var marker = L.marker([latitude, longitude]).addTo(map);
    var circle = L.circle([-7.56079602588411, 112.70168579771881], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 1000
    }).addTo(map);


    //pop up nama
    var popup = L.popup()
        .setLatLng([latitude, longitude])
        .setContent("{{ $presensi->nama_lengkap }}")
        .openOn(map);
</script>
