@extends('user.layout.app')

@section('title', 'Orders')

@section('content')
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Order Lists</h4>
      <p class="card-description">
        All your order lists will be show here
      </p>
      <div class="row">
      <div class="col-12">
      <div class="table-responsive">
        <table id="datatables" class="display table-hover table expandable-table w-100">
          <thead>
            <tr>
              <th>Order No</th>
              <th>Method</th>
              <th>Booking Date</th>
              <th>Payment Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $item)
<tr>
  <td> {{ $item->order_no }} </td>
  <td> {{ $item->payment_method }} </td>
  <td> {{ $item->booking_date }} </td>
  <td> {{ $item->status }} </td>
  <td id="order-2">
    <a href="{{route('order-details', $item->id)}}"><button type="button" class="btn btn-warning btn-rounded btn-fw btn-sm text-white">See Details</button></a>
    <a href="{{route('order.invoice.download', $item->id)}}" target="_blank"><button type="button" class="btn btn-primary btn-rounded btn-fw btn-sm text-white">See Invoice</button></a>
    @if($item->status == 'PENDING' || $item->status == 'SUCCESS')
    <a href="{{route('order.cancel', $item->id)}}"><button type="button" class="btn btn-danger btn-rounded btn-fw btn-sm text-white">Cancel Order</button></a>
    @endif
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#reviewModal">Submit Review</button>
  </td>              
</tr>
@endforeach

<!-- Modal -->
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
              <form action="{{ route('submit-review', $item->id) }}" method="POST">
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


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('js-custom')
<script>
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
              
              // <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
              //   <div class="modal-dialog" role="document">
              //     <div class="modal-content">
              //       <div class="modal-header">
              //         <h5 class="modal-title" id="detailModalLabel">Order Details</h5>
              //         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              //           <span aria-hidden="true">&times;</span>
              //         </button>
              //         </div>
              //        <div class="modal-body">
              //         <div class="table-responsive">
              //           <table class="table">
              //             <tbody>
              //               <tr id="order-1">
              //                 <td>Customer Name:</td>
              //                 <td>Farras</td>
              //               </tr>
              //               <tr>
              //                 <td>Email Address:</td>
              //                 <td>emailcustomer@gmail.com</td> 
              //               </tr>
              //               <tr>
              //                 <td>Phone:</td>
              //                 <td>08214271xxxx</td>
              //               </tr>
              //               <tr>
              //                 <td>Pay Method:</td>
              //                 <td>Virtual Account</td>
              //               </tr>
              //               <tr>
              //                 <td>Booked:</td>
              //                 <td>08-15-2023</td>
              //               </tr>
              //               <tr>
              //                 <td>Travel Date:</td>
              //                 <td>10-15-2023 to 10-25-2023</td>
              //               </tr>
              //               <tr>
              //                 <td>Tipe Kamar:</td>
              //                 <td>Deluxe Suit</td>
              //               </tr>
              //               <tr>
              //                 <td>Fasilitas:</td>
              //                 <td>Wifi, King Bed Size <br> Beautiful View Balcony</td>
              //               </tr>
              //               <tr>
              //                 <td>Invoice Pembayaran:</td>
              //                 <td><button type="button" class="btn btn-primary btn-rounded btn-fw btn-sm text-white">See Invoice</button></td>
              //               </tr>
              //               <tr>
              //                 <td>Permintaan Khusus:</td>
              //                 <td>Tambah 2 Bantal</td>
              //               </tr>
              //             </tbody>
              //           </table>
              //         </div>
              //       </div>
              //       <div class="modal-footer">
              //         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              //       </div>
              //     </div>
              //   </div>
              // </div>
</script>
@endpush

