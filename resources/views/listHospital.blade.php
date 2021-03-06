@extends('layouts.app')

@section('content')

    @include('layouts.inc.navbar')

    <div class="container-fluid">
            <div class="jumbotron p-4 p-md-5 text-white rounded bg-primary">
                <div class="row justify-content-center">
                    <div class="col-md-6 px-0">
                      {{-- <img src="https://i.ibb.co/JQbV1BQ/sifiks5.png" width="45%" alt="sifiks5" border="0"> --}}
                    <h1 class="display-4 font-bold" >Cari Tindakan Medis</h1>
                    <p class="lead my-3" >Kekayaan bukan berasal dari uang, melainkan kesehatan</p>
                    {{-- <hr> --}}
                    <ul>
                      <li>Bandingkan estimasi antar rumah sakit yang anda inginkan</li>
                      <li>Terdapat berbagai Tindakan medis yang anda inginkan</li>
                      <li>Temukan Rumah Sakit yang terdekat dengan lokasi anda</li>

                    </ul>
                    <br>
                    {!! Form::open(['action' => 'HospitalController@searchHospital','method'=> 'POST']) !!}
                    @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="tentang">Saya mencari informasi tentang:</label>
                                <div class="input-group">
                                    {{Form::text ('nama','',['class'=>'form-control','placeholder'=>'Cari Tindakan Medis'])}}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="location">Lokasi</label>
                                <div class="input-group">
                                    {{ Form::select(
                                        'location',
                                        $data['location'],
                                        null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Pilih Kota'
                                        ]
                                    )}}
                                    <div class="input-group-append">
                                        {{Form::submit('Cari',['class'=>'btn btn-warning'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      {{-- <div class="img-fluid"> --}}
                          <img src="{{ asset('storage/images/dokterhome.png') }}" alt="Dokter" class="float-left" width="100%">
                      {{-- </div> --}}
                  </div>
                </div>
            </div>
        </div>

    <!-- filter city -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            {{--<h3>Pilih Tindakan</h3>

                <div class="box-filter">
                    <ul class="dataList">
                            <div class="input-group">
                                    <input id="lokasi" type="text" class="form-control" placeholder="Tindakan Terkait">
                                    <div class="input-group-append">
                                        <button class="btn btn-warning">Cari</button>
                                    </div>
                                </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">Semua Tindakan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">Analisa Gas Darah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                            <label class="form-check-label" for="exampleRadios3">Cek Asam Urat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                            <label class="form-check-label" for="exampleRadios4">Cek Golongan Darah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option5">
                            <label class="form-check-label" for="exampleRadios5">Cek Kolesterol</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Elektroforesis</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Fungsi Ginjal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Hitung Darah Lengkap</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Patologi Anatomi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Pemeriksaan Feses</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                            <label class="form-check-label" for="exampleRadios6">Pemeriksaan Kimia Klinik</label>
                        </div>
                    </div>

                    </ul> --}}
                </div>


                    <!-- list doctor -->
                <div class="col-md-8">
                    <br>
                    <h1 class="font-weight-bold">Estimasi Biaya Rumah Sakit</h1>
                    @if(count($data['hospital'])>0)
                        @foreach($data['hospital'] as $hospital)
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        @if($hospital->cover_images_id = null)
                                            <img src="{{ asset('storage/images/hospital.jpg')}}" alt="{{$hospital->name}}" class="card-img" >
                                        @else
                                            <img src="{{ asset('storage/images/hospital.jpg')}}" alt="{{$hospital->name}}" class="card-img">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$hospital->name}}</h5>
                                            <p class="card-text">{!! Str::limit($hospital->biography) !!}</p>
                                            <a href="{{ route('view.hospital' , ['id' => $hospital->id])}}" class="btn btn-primary">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert alert-danger text-center">
                                <strong>Maaf data yang anda cari tidak ada.</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
        </div>
    </div>
@endsection
