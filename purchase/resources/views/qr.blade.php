@extends('template')
 
@section('title_RFQ', 'active')
 
@section('sidebar')
    @parent
@endsection

@section('title_')
<h5 id="form">Request for Quotation</h5><br>
@endsection

@section('content')
    <div class="shadow p-3 mb-5 bg-white rounded">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <!-- <a href="{{url('PurchaseRequest/create')}}" class="btn btn-success">CREATE</a><br><br> -->
        <br>
        <form action="" method="get" class="row mb-4 ml-1">
            <?php $id_quotation = [] ?>
            <select name="id_quotation" class="form-control col-sm-3 mr-2">
                <option value="">Filter Request For Quotation</option>
                @foreach ($pur_req as $vendors)
                    @if($vendors->status != "Deleted" && !in_array($vendors->id_quotation, $id_quotation))
                    <?php if(!in_array($vendors->id_quotation, $id_quotation)) array_push($id_quotation, $vendors->id_quotation) ?>
                    <option <?= isset($_GET['id_quotation'])&& $_GET['id_quotation'] == $vendors->id_quotation ? "selected" : "" ?> value="{{ $vendors->id_quotation }}">{{ $vendors->id_quotation }}</option>

                    @endif
                @endforeach 
            </select>
            <?php $vendor_name = [] ?>
            <select name="vendor_name" class="form-control col-sm-3 mr-2">
                <option value="">Filter Vendor </option>
                @foreach ($pur_req as $vendors)
                    @if($vendors->status != "Deleted" && !in_array($vendors->vendor_name, $vendor_name))
                    <?php if(!in_array($vendors->vendor_name, $vendor_name)) array_push($vendor_name, $vendors->vendor_name) ?>
                    <option <?= isset($_GET['vendor_name']) && $_GET['vendor_name'] == $vendors->vendor_name ? "selected" : "" ?> value="{{ $vendors->vendor_name }}">{{ $vendors->vendor_name }}</option>

                    @endif
                @endforeach 
            </select>
            <?php $produk = [] ?>
            <select name="produk" class="form-control col-sm-2 mr-2">
                <option value="">Filter Product</option>
                @foreach ($pur_req as $vendors)
                    @if($vendors->status != "Deleted" && !in_array($vendors->produk, $produk))
                    <?php if(!in_array($vendors->produk, $produk)) array_push($produk, $vendors->produk) ?>
                    <option <?= isset($_GET['produk']) && $_GET['produk'] == $vendors->produk ? "selected" : "" ?> value="{{ $vendors->produk }}">{{ $vendors->produk }}</option>

                    @endif
                @endforeach 
            </select>
            <?php $status = [] ?>
            <select name="status" class="form-control col-sm-2 mr-2">
                <option value="">Filter Status</option>
                @foreach ($pur_req as $vendors)
                    @if($vendors->status != "Deleted" && !in_array($vendors->status, $status))
                    <?php if(!in_array($vendors->status, $status)) array_push($status, $vendors->status) ?>
                    <option <?= isset($_GET['status']) && $_GET['status'] == $vendors->status ? "selected" : "" ?> value="{{ $vendors->status }}">{{ $vendors->status }}</option>

                    @endif
                @endforeach 
            </select>
            <button type="submit" class="btn btn-success mr-1">Filter</button>
            <a href="/RequestQuotations" class="btn btn-success">Reset</a>
        </form>
        <table class="table table-striped table-hover">
            <tr>
                <th>No</th>
                <th>Request For Quotation</th>
                <th>Vendor Name</th>
                <th>Product</th>
                <th>Created Date</th>
                <th>Status</th>
            </tr>
            <?php $no=1 ?>
            @forelse ($pur_req as $vendors)      

            <?php 
                $id_quotation = (isset($_GET['id_quotation']) && $_GET['id_quotation'] != "") ? (isset($_GET['id_quotation']) && $_GET['id_quotation'] == $vendors->id_quotation ? true : false) : true;
                $vendor_name = (isset($_GET['vendor_name']) && $_GET['vendor_name'] != "") ? (isset($_GET['vendor_name']) && $_GET['vendor_name'] == $vendors->vendor_name ? true : false) : true;
                $produk = (isset($_GET['produk']) && $_GET['produk'] != "") ? (isset($_GET['produk']) && $_GET['produk'] == $vendors->produk ? true : false) : true;
                $status = (isset($_GET['status']) && $_GET['status'] != "") ? (isset($_GET['status']) && $_GET['status'] == $vendors->status ? true : false) : true;
            ?>     

            @if($vendors->status != "Deleted" && $id_quotation && $vendor_name && $produk && $status)

            <tr  class="border px-4 py-2" onclick="window.location=' {{route('RequestQuotations.show', $vendors->id_quotation)}}' " style="cursor: pointer;">               
                      
                <td>{{ $no++ }}</td>
                <td>{{ $vendors->id_quotation }}</td>
                <td>{{ $vendors->vendor_name }}</td>
                <td>{{ $vendors->produk }}</td>
                <td>{{ $vendors->created_at }}</td>
                <td>{{ $vendors->status }}</td>                
            </tr>
            @endif
            @empty
                <div class="alert alert-danger">
                    Data Purchase Request belum Tersedia.
                </div>
            @endforelse 
        </table>
        {{ $pur_req->links() }}
    </div>
@endsection