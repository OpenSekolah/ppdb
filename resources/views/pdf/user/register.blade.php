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
                <tr class="font-bold">
                    <td valign="top">2.</td>
                    <td valign="top">Registrasi Peserta Didik</td>
                    <td valign="top"></td>
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
                    <td valign="top">Alamat</td>
                    <td valign="top">:</td>
                    <td valign="top">{{$register_form->address}}</td>
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
            </tbody>
        </table>
    </div>
</html>