<style>
    .isi{
        color: rgb(79, 79, 79)
    }
    .judul{
        margin-top:1em;
    }
</style>
@extends('layouts.template')
@section('content')
<div class="col mt-2">
    <a href="{{route('pengguna')}}"><i class="bi bi-arrow-left-circle-fill" style="font-size: 24px"></i></a>
</div>
<div class="container mt-2" style="background-color: white">
    <br>
    <section class="section">
        <div class="col-md-12">
            <div class="card mt-2" style="border: 1px solid rgb(85, 85, 85);margin-left:2em;margin-right:2em;"> 
             
                <div class="card-body mt-4" style="margin-left:3em;margin-right:3em;">
                        <div  class="col-md-12">  
                            <center>
                                <h4>Detail User</h4>
                              
                                <img class="img-rounded" width="100px" height="100px" src="{{asset('/foto/'.$pengguna->foto)}}" alt="" style="border-radius: 100%">
                               
                            <div class="col-md-12 mt-4">
                                <div>
                                    <h5 class="judul">Nama Lengkap</h5>
                                    <h6 class="isi">{{$pengguna->name}}</h6>
                                </div>
                                <div>
                                    <h5 class="judul">Email</h5>
                                    <h6 class="isi">{{$pengguna->email}}</h6>
                                </div>
                                <div>
                                    <h5 class="judul">Username</h5>
                                    <h6 class="isi">{{$pengguna->username}}</h6>
                                </div>
                                <div>
                                    <h5 class="judul">Kontak</h5>
                                    <h6 class="isi">{{$pengguna->kontak}}</h6>
                                </div>
                            
                                

                            </div>
                            </center>
                        </div>

                           
                           
                      

                    </div>

                </div>
               


            </div> 
        </div>
       

    </section>
    
</div>

@endsection