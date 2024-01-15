@extends('layouts.parent')
@section('title', 'All Product')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    @include('messages.message')
    <!-- Main content -->
    <div class="card w-100">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body w-100">
            <table id="example1" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Ar</th>
                        <th>Name En</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $product->name_ar }}</td>
                            <td>{{ $product->name_en }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->status ? 'Active' : 'Not Active' }}</td>
                            @if ($product->quantity >= 0 and $product->quantity <= 5)
                                <td class="text-danger">{{ $product->quantity }}</td>
                            @elseif($product->quantity > 5 and $product->quantity < 10)
                                <td class="text-warning">{{ $product->quantity }}</td>
                            @else
                                <td class="text-success">{{ $product->quantity }}</td>
                            @endif
                            <td>{{ $product->created_at }}</td>
                            <td>
                              {{-- {{url('edit-product/'.$product->id)}} --}}
                                <a href="{{route('my-dashboard.products.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                                <form method="post" action="{{route('my-dashboard.products.destroy', $product->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
