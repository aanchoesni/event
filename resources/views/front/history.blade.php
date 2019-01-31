@extends('layouts.front.master')

@section('title')
    History
@endsection

@section('content')
<div class="col-lg-12">
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th>Event</th>
                <th>Jadwal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $value)
            <tr>
                <td style="vertical-align: middle">{!! $value->rEvent->title !!}</td>
                <td style="vertical-align: middle">
                    <div>Tanggal : {!! $value->rEvent->date !!}</div>
                    <div>Pukul : {!! $value->rEvent->times !!}</div>
                    <div>Tempat : {!! $value->rEvent->place !!}</div>
                </td>
                <td style="vertical-align: middle">
                    @if ($value->is_valid == 1)
                    <div style="color: green;"><i class="fa fa-check"></i></div>
                    @else
                    <div style="color: red;"><i class="fa fa-times"></i></div>
                    @endif
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <div>
                        <a href="{!! url('cetakkartu') !!}" class="btn btn-sm btn-success"> Cetak Kartu</a>
                    </div>
                    @if ($value->rEvent->pay_status == true)
                    <div>
                        <a href="{!! url('paymentconfirmation') !!}" class="btn btn-sm btn-warning"> Konfirmasi Pembayaran</a>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
