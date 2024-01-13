<form action="/konfigurasi/updateJK" method="POST" id="frmJK">
    @csrf

    {{-- tambah kode jam kerja --}}
    <div class="col-12">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            </span>
            <input type="text" value="{{$jam_kerja->kode_jam_kerja}}" readonly class="form-control" name="kode_jam_kerja" id="kode_jam_kerja"
                placeholder="KODE JAM KERJA">
        </div>
    </div>

    {{-- tambah nama JAM KERJA --}}
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                </span>
                <input type="text" id="nama_jam_kerja" name="nama_jam_kerja" value="{{$jam_kerja->nama_jam_kerja}}" class="form-control"
                    placeholder="NAMA JAM KERJA">
            </div>
        </div>

        {{-- tambah awal jam masuk --}}
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M12 10l0 3l2 0" />
                        <path d="M7 4l-2.75 2" />
                        <path d="M17 4l2.75 2" />
                    </svg>
                </span>
                <input type="text" id="awal_jam_masuk" name="awal_jam_masuk" value="{{$jam_kerja->awal_jam_masuk}}" class="form-control"
                    placeholder="AWAL JAM MASUK">
            </div>
        </div>

        {{-- tambah jam masuk --}}
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M12 10l0 3l2 0" />
                        <path d="M7 4l-2.75 2" />
                        <path d="M17 4l2.75 2" />
                    </svg>
                </span>
                <input type="text" id="jam_masuk" name="jam_masuk" value="{{$jam_kerja->jam_masuk}}" class="form-control"
                    placeholder="JAM MASUK">
            </div>
        </div>

        {{-- tambah akhir jam masuk --}}
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M12 10l0 3l2 0" />
                        <path d="M7 4l-2.75 2" />
                        <path d="M17 4l2.75 2" />
                    </svg>
                </span>
                <input type="text" id="akhir_jam_masuk" name="akhir_jam_masuk" value="{{$jam_kerja->akhir_jam_masuk}}" class="form-control"
                    placeholder="AKHIR JAM MASUK">
            </div>
        </div>

        {{-- tambah jam pulang --}}
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 13m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M12 10l0 3l2 0" />
                        <path d="M7 4l-2.75 2" />
                        <path d="M17 4l2.75 2" />
                    </svg>
                </span>
                <input type="text" id="jam_pulang" name="jam_pulang" value="{{$jam_kerja->jam_pulang}}" class="form-control"
                    placeholder="JAM PULANG">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 14l11 -11" />
                            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                        </svg>
                        Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
