<form action="/tni_al/{{$tni_al->nrp}}/update" method="POST" id="frmtni_al" enctype="multipart/form-data">
    @csrf

    <div class="col-12">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 10l2 -2v8" />
                    <path
                        d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3" />
                    <path
                        d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5" />
                </svg>
            </span>
            <input type="text" readonly value="{{$tni_al->nrp}}" class="form-control" name="nrp" id="nrp"
                placeholder="NRP">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                </span>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{$tni_al->nama_lengkap}}"
                    class="form-control" placeholder="Masukan Nama">
            </div>
        </div>


        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-arrow-badge-down" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 13v-6l-5 4l-5 -4v6l5 4z" />
                    </svg>
                </span>
                <input type="text" value="{{$tni_al->pangkat}}" name="pangkat" class="form-control"
                    id="pangkat" placeholder="Pangkat">
            </div>
        </div>

        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-user-scan" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                        <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                        <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" />
                    </svg>
                </span>
                <input type="text" value="{{$tni_al->jabatan}}" name="jabatan" class="form-control"
                    id="jabatan" placeholder="Jabatan">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <select name="kode_dept" class="form-select" id="kode_dept">
                    <option value="">Departemen</option>
                    @foreach ($departemen as $d)
                        <option {{ $tni_al->kode_dept == $d->kode_dept ? 'selected' : '' }}
                            value="{{ $d->kode_dept }}">
                            {{ $d->nama_dept }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <select name="kode_kot" id="kode_kot" class="form-select">
                    <option value="">Kotama</option>
                    @foreach ($kotama as $d)
                        <option {{ $tni_al->kode_kot == $d->kode_kot ? 'selected' : '' }}
                            value="{{ $d->kode_kot }}">
                            {{ $d->nama_kot }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <select name="kode_roll" id="kode_roll" class="form-select">
                    <option value="">Roll</option>
                    @foreach ($roll as $d)
                        <option {{ $tni_al->kode_roll == $d->kode_roll ? 'selected' : '' }}
                            value="{{ $d->kode_roll }}">
                            {{ $d->nama_roll }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                </span>
                <input type="text" value="{{$tni_al->no_hp}}" id="no_hp" name="no_hp"
                    class="form-control" placeholder="No Handphone">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <input type="file" name="foto" name="foto" class="form-control">
                <input type="hidden" name="old_foto" value="{{$tni_al->foto}}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-send" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 14l11 -11" />
                            <path
                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                        </svg>
                        Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>