<form action="/kotama/update" method="POST" id="frmKotamaEdit">
    @csrf
    <div class="col-12">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 10l2 -2v8" />
                    <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3" />
                    <path
                        d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5" />
                </svg>
            </span>
            <input type="text" value="{{ $kotama->kode_kot }}" readonly class="form-control" name="kode_kot"
                id="kode_kot" placeholder="KODE KOTAMA">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21l18 0" />
                        <path d="M5 21v-14l8 -4v18" />
                        <path d="M19 21v-10l-6 -4" />
                        <path d="M9 9l0 .01" />
                        <path d="M9 12l0 .01" />
                        <path d="M9 15l0 .01" />
                        <path d="M9 18l0 .01" />
                    </svg>
                </span>
                <input type="text" id="nama_kot" name="nama_kot" value="{{ $kotama->nama_kot }}"
                    class="form-control" placeholder="Nama Kotama">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            <path
                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                        </svg>
                    </span>
                    <input type="text" id="lokasi_kot" name="lokasi_kot" value="{{ $kotama->lokasi_kot }}"
                        class="form-control" placeholder="Lokasi Kotama">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" />
                                <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" />
                                <path d="M12 12v9" />
                            </svg>

                        </span>
                        <input type="text" id="radius" name="radius" value="{{ $kotama->radius }}"
                            class="form-control" placeholder="Radius">
                    </div>
                </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 14l11 -11" />
                                    <path
                                        d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                </svg>
                                Simpan</button>
                        </div>
                    </div>
                
            </div>
</form>
<script>
    $(function() {
        $("#frmKotamaEdit").submit(function() {
            var kode_kot = $("#frmKotamaEdit").find("#kode_kot").val();
            var nama_kot = $("#frmKotamaEdit").find("#nama_kot").val();
            var lokasi_kot = $("#frmKotamaEdit").find("#lokasi_kot").val();
            var radius = $("#frmKotamaEdit").find("#radius").val();

            if (kode_kot == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Kode Kotama Harus Di isi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kode_kot").focus();
                });
                return false;
            } else if (nama_kot == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Nama Kotama Harus Di isi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#nama_kot").focus();
                });
                return false;
            } else if (lokasi_kot == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Lokasi Kotama Harus Di isi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#lokasi_Kot").focus();
                });
                return false;
            } else if (radius == "") {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Radius Absen Harus Di isi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#radius").focus();
                });
                return false;
            }
        })

    });
</script>
