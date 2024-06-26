@extends('user.layout.app')

@section('title', 'Invoices')

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Invoice Lists</h4>
        <p class="card-description">
          All your Invoices lists will be show here
        </p>
        <div class="row">
          <div class="col-12">
              <div class="table-responsive">
                  <table id="datatables" class="display table-hover table expandable-table w-100">
                      <thead>
                          <tr>
                              <th>Order ID</th>
                              <th>Room Name</th>
                              <th>Total</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($order_details as $item)
                              @php
                                  $order = $orders->firstWhere('id', $item->order_id);
                              @endphp
                              <tr>
                                  <td>{{ $item->order_id }}</td>
                                  <td>{{ $item->room_name }}</td>
                                  <td>{{ $order->payment_method }}</td>
                                  <td id="order-2">
                                      <!-- Tambahkan tombol 'Submit Review' -->
                                      <button type="button" class="btn btn-success btn-rounded btn-fw btn-sm text-white" data-toggle="modal" data-target="#reviewModal">Submit Review</button>

                                      <!-- Modal -->
                                      <div id="reviewModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Submit Review</h4>
                                              <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('/submit-review', $item->id) }}" method="POST">
                                                  @csrf
                                                  <div class="form-group">
                                                      <label for="title">Title:</label>
                                                      <input type="text" id="title" name="title" placeholder="Enter title here..." class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="content">Comment:</label>
                                                      <textarea id="content" name="content" placeholder="Write your comment here..." class="form-control"></textarea>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                
                                        </div>
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
  </div>

@push('js-custom')
<script>

// Tambahkan kode JavaScript Anda di sini jika diperlukan

</script>

@endpush

@endsection
