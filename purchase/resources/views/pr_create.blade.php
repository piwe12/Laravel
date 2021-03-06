@extends('templateWithOutSearch')

@section('title_PurReq', 'active')

@section('sidebar')
    @parent
@endsection

@section('title_')
<h5 id="form">Purchase Request</h5><br>
@endsection

@section('content')
    <div class="shadow p-3 mb-5 bg-white rounded">
        <form method="post" action="{{route('PurchaseRequest.store')}}" id="dynamic_form">
        @csrf
        <!-- @method('PUT') -->
            <!-- <input type="submit" name="save" id="save" class="btn btn-success" value="Save"> -->
            <a href="#" onclick="history.back()" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-success">Discard</button><br><br>

            <div class="container col-md-9">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="vendor">Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendor" required>
                            @forelse ($vendor as $vendors)
                                <option value="{{$vendors->id_vendor}}">{{$vendors->vendor_name}}</option>
                            @empty
                            @endforelse
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="create_date">Create Date</label>
                            <input  class="form-control"type="date" name="create_date" disabled required id="create_date" value="{{ date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" id="notes" cols="5" rows="5" required ></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="order_date">Order Date</label>
                            <input  class="form-control" type="date" name="order_date" min="<?= date("Y-m-d") ?>" required id="order_date">
                        </div>
                    </div>
                </div>
            </div><br><br>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Unit of Measure</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
    $(document).ready(function(){

        var count = 1;

        dynamic_field(count);

        function dynamic_field(number)
        {
            html = '<tr>';
            html += '<td><select name="product_code[]" id="product_code[]" class="form-control product-select" required><option>Pilih Produk</option>'+
            '@foreach ($produk as $produks)<option data-id_vendor="{{$produks->id_vendor}}" value="{{$produks->id_produk}}">{{$produks->nama_produk}}</option>@endforeach</select></td>';
            html += '<td><input type="text" name="description[]" class="form-control" required /></td>';
            html += '<td><input type="text" name="unit[]" class="form-control" required /></td>';
            html += '<td><input type="number" name="qty[]" class="form-control" required min="1" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                $('tbody').append(html);
            }
            else
            {
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">+ Add an item</button></td></tr>';
                $('tbody').html(html);
                reset();
            }
        }

        function reset(){
            $(".product-select").prop('selectedIndex', -1);
        }

        function setList(){
            $(`select[name="product_code[]"] option`).addClass("d-none")
            $(`select[name="product_code[]"] option[data-id_vendor="${$(`select[name="vendor_id"]`).val()}"]`).removeClass("d-none")
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
            setList();
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });

        $('select[name=vendor_id]').on('change', function() {
            reset();
            setList();
        });

        reset();
        setList();
    });
</script>
@endsection
