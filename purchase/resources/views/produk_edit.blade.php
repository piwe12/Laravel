@extends('templateWithOutSearch')
 
@section('title_Product', 'active')
 
@section('sidebar')
    @parent
@endsection
 
@section('title_')
<h5 id="form">Product</h5><br>
@endsection

@section('content')
<div class="shadow p-3 mb-5 bg-white rounded">
    <form action="{{route('Produk.update', $produk->id_produk)}}" method="post">
    @csrf
    <a href="#" onclick="history.back()" class="btn btn-success">Back</a>

    @method('PUT')
    @if(Auth::user()->level == 'admin')
    <button type="submit" class="btn btn-success">Update</button>            
    <button type="reset" class="btn btn-success">Discard</button>
    <a href="{{URL::to('delete_prod', $produk->id_produk)}}" class="btn btn-success">Delete</a><br><br>
    @endif
        <div class="form-group container col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Product Name</label>
                </div>
                <div class="col-md-3">
                    <input required value="{{$produk->nama_produk}}" type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="stok">Stok</label>
                </div>
                <div class="col-md-3">
                    <input required value="{{$produk->stok}}" type="number" name="stok" id="stok" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-3">
                    <label for="harga">Price</label>
                </div>
                <div class="col-md-3">
                    <input required value="{{$produk->price}}" type="number" name="price" id="price" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="type">Type</label>
                </div>
                <div class="col-md-3">
                    <input required value="{{$produk->type}}" type="text" name="type" id="type" class="form-control">
                </div>
                <div class="col-md-3 mt-4 mb-2">
                    <label for="stok">Vendor</label>
                </div>
                <div class="col-md-3 mt-4 mb-2">
                    <select name="id_vendor" required class="form-control">
                        <option value="">Pilih Vendor</option>
                        @foreach($vendor as $value)
                        <option {{ $produk->id_vendor == $value->id_vendor ? "selected" : "" }} value="{{$value->id_vendor}}">{{$value->vendor_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><br>
            
        </div>
    </form>
</div>
@endsection
