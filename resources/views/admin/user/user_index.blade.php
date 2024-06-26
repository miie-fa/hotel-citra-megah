@extends('admin.layout.app')

@section('title', 'Users')

@section('content')
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">View Users</h3>
                                </div>
                                </div>
                                <div class="card-body">
                                <div class="toolbar">
                                    <a href="{{ route('users.create') }}">
                                        <button class="btn btn-info btn-sm">+ Add New</button>
                                    </a>
                                </div>
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th class="text-right disabled-sorting">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($users as $key => $item)
                                          @if ($item->role == 'user')
                                          <tr>
                                              <td>{{ $key + 1 }}</td>
                                              <td>{{ $item->name }}</td>
                                              <td>{{ $item->email }}</td>
                                              <td> {{ $item->role }} </td>
                                              <td class="text-right">
                                                  <a href="{{ route('users.show', $item->id)}}"><button class="btn btn-sm btn-warning">Detail</button></a>
                                                  <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm text-light btn-info">Edit</a>
                                                  <form action="{{ route('users.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                  </form>
                                              </td>
                                          </tr>
                                      @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="mr-auto">Pemberitahuan</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{ session('success') }}
        </div>
      </div>
    @endif

@endsection


@push('js-custom')
    <script>
        $(document).ready(function(){
            $('.toast').toast('show');
        })
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
                }
            });

            var table = $('#datatable').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });
        });
    </script>
@endpush
