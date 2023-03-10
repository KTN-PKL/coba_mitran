<style>
     .badge-refund {
   color: #ebeef0;
   background-color: #F96A2C;
   font-size:16px;
}
    .badge-process {
   color: #ebeef0;
   background-color: #F28F1A;
   font-size:16px;
}
.badge-available {
   color: #ebeef0;
   background-color: #25D977;
   font-size:16px;
}
</style>

@extends('layouts.template')
@section('content')
<div class="col mt-2">
    <a href="{{ route('pengunjung') }}"><i class="bi bi-arrow-left-circle-fill" style="font-size: 24px"></i></a>
</div>
<div class="container">
<h3>Daftar Pengunjung Mitra, {{ $mitra->name }}</h3>
    <br>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengunjung</th>
                            <th>Tempat Wisata</th>
                            <th>Whatsapp</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($pengunjung as $pengunjungs)
                        <tr>
                            <td>@php
                                $i = $i + 1;
                                echo $i;
                            @endphp</td>
                            <td style="width:25%">{{ $pengunjungs->atas_nama }}</td>
                            <td style="width:25%">{{ $pengunjungs->wisata }}</td>
                            <td>{{ $pengunjungs->whatsapp }}</td>
                            <td>
                                @if($pengunjungs->status == "checkin")
                                <span class="badge bg-success"><i class="bi bi-patch-check" style="font-size: 18px"></i> Check-in</span>
                                @elseif($pengunjungs->status == "expired")
                                <span class="badge bg-danger"><iconify-icon style="font-size: 12px" icon="mdi:clock-remove-outline"></iconify-icon> Expired</span>
                                @elseif($pengunjungs->status == "refund")
                                <span class="badge badge-refund"><iconify-icon icon="mdi:cash-refund"></iconify-icon> Refund</span>
                                @elseif($pengunjungs->status == "process refund")
                                <span class="badge badge-process"><iconify-icon icon="mdi:cash-refund"></iconify-icon> Process Refund</span>
                                @elseif($pengunjungs->status == "available")
                                <span class="badge badge-available"><iconify-icon style="font-size:14px" icon="mdi:clock-check-outline"></iconify-icon> Available</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pengunjung.detail', $pengunjungs->kode_tiket) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    
</div>

@endsection