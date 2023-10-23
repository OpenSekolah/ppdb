<!DOCTYPE html>
<html>
<head>
    <title>Formulir_PPDB NAMA SISWA</title>
</head>
<style type="text/css">
    body{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10pt !important;
    }

    .mt-10{
        margin-top:10px;
    }

    .font-bold {
        font-weight: bold !important;
    }

    .w-100{
        width: 100% !important;
    }

    .text-center{
        text-align:center !important;
    }

    .tablex th, .tablex td {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
</style>
<body>
    <div>
        <h3 class="text-center">Formulir Pendaftaran Peserta Didik Baru Tahun {{$register_form->admission->year}} Gelombang {{$register_form->admission->stage}} </h3>
        <table class="tablex w-100 mt-10">
            <tbody>
                <tr class="font-bold">
                    <td width="1%">1.</td>
                    <td width="40%">Registrasi Peserta Didik</td>
                    <td width="1%"></td>
                    <td valign="top"></td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Nama Lengkap</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->name}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">NISN</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->nisn}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Tempat/Tanggal Lahir</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->place_of_birth}} / {{$register_form->dateOfBirthAt}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Asal Sekolah</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->from_school}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Pilihan Jurusan 1</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->competencefirst->name}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Pilihan Jurusan 2</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->competencesecond->name}}</td>
                </tr>
                <tr class="font-bold">
                    <td><br/><br/></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="font-bold">
                    <td valign="top">2.</td>
                    <td valign="top">Alamat</td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Status Tempat Tinggal</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->residence}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Alamat</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->address}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">RT/RW</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->rt}}/{{$register_form->addresses->rw}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Desa</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->village}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Kecamatan</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->subdistrict}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Provinsi</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->province}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Kodepos</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->postal_code}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Koordinat Alamat</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->address_coordinates}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Transportasi</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->transportation}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Jarak dari rumah ke sekolah</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->distance}}</td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top">Waktu Tempuh</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->addresses->traveling_time}}</td>
                </tr>
                <?php 
                    $ordernumber = 2;
                    $name_table = "";
                ?>
                @foreach ($register_form->parent_guardians as $value)
                    <?php $ordernumber++?>
                    <tr class="font-bold">
                        <td><br/><br/></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="font-bold">
                        <td valign="top">{{ $ordernumber }}.</td>
                        <td valign="top">Data {{$value->data_type}}</td>
                        <td valign="top"></td>
                        <td valign="top"></td>
                    </tr>
                    @if($value->data_type != 'wali')
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Status {{$value->data_type}}</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->status}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Nik</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->nik}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Nama {{$value->data_type}}</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->name}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Tempat/Tanggal Lahir</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->place_of_birth}} / {{Carbon\Carbon::parse($value->date_of_birth)->translatedFormat('d F Y')}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Pendidikan</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->education}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Pekerjaan</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->work}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">Penghasilan</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->income}}</td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">No. HP</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$value->phone}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</html>