@extends('layouts.adm-app')
@section('content')
    <section class="content-header">
        <h1>
            <a href="{{ url()->previous() }}" class="btn btn-default">
                <i class="fa fa-chevron-left"></i>
            </a>&nbsp;&nbsp;&nbsp;
            Detil Rumah Sakit
            <small><b>( {{ $data['hospital']->name }} )</b></small>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fas fa-tachometer-alt"></i> {{ session('role') }}</a></li>
            <li><a href="{{ route('hospital.index') }}">Rumah Sakit</a></li>
            <li class="active">
                {{ $data['hospital']->name  }}
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
                <strong>Tentang {{ $data['hospital']->name }}</strong>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                        {{--<i class="fa fa-times"></i>--}}
                    {{--</button>--}}
                </div>
            </div>
            <div class="box-body with-border">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12"></div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <h2>{{ $data['hospital']->name }}</h2>
                                <p>
                                    Terakhir diubah
                                    &nbsp;<strong>{{ $data['hospital']->updated_at->diffForHumans() }}</strong>
                                </p><br>
                                {!! $data['hospital']->biography !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Layanan Medis</h4>
                                        {!! $data['hospital']->medical_services !!}
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Layanan Publik</h4>
                                        {!! $data['hospital']->public_services !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        @include('layouts.inc.messages')

        <div class="box box-primary">
            <div class="box-header with-border">
                <strong>Daftar Kamar di {{ $data['hospital']->name }}</strong>
                <a href="{{ route('room.create', $data['hospital']->id) }}" class="btn btn-success pull-right">
                    <strong>
                        <i class="fa fa-plus"></i>
                        &nbsp;Tambah Kamar
                    </strong>
                </a>
                {{--<div class="box-tools pull-right">--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"--}}
                {{--title="Collapse">--}}
                {{--<i class="fa fa-minus"></i></button>--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                {{--<i clasbhbbs="fa fa-times"></i></button>--}}
                {{--</div>--}}
            </div>
            <div class="box-body">
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(count($data['rooms']) > 0)
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Harga</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Deskripsi</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Ditinjau</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Terakhir diubah</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"></th>
                                        </tr>
                                        </thead>
                                        @foreach($data['rooms'] as $room)
                                            <tbody>
                                            <tr role="row" class="odd">
                                                <td>{{ $room->name }}</td>
                                                <td>Rp. {{ number_format($room->price_per_night, 2, ",", ".") }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('room.show', ['room_id' => $room->id, 'hospital_id' => $data['hospital']->id]) }}" class="btn btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($room->created_at)->format("d M Y") }}</td>
                                                <td>{{ \Carbon\Carbon::parse($room->updated_at)->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <button onclick="$('#delRoom').submit()" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fas fa-trash"></i>
                                                    </button>
                                                    <a href="{{ route('room.edit', ['room_id' => $room->id, 'hospital_id' => $data['hospital']->id]) }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fas fa-sync"></i>
                                                    </a>
                                                    <form onsubmit="return confirm('Apakah anda yakin ingin menghapus ?')" id="delRoom" method="post" action="{{ route('room.destroy', ['room_id' => $room->id, 'hospital_id' => $data['hospital']->id]) }}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="id" value="">
                                                    </form>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                        {{--{{$data['rooms'][$i]->links()}}--}}
                                    </table>
                                @else
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="alert alert-danger text-center">
                                                <strong>Maaf tidak ada konten.</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection
