    <?php


    use App\Http\Controllers\Controller;
    use App\Models\Order;
    use App\Models\OrderDetail;
    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    class AdminOrderController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $orders = Order::get();
            return view('admin.order.order_index', compact('orders'));
        }

        /**
         * Display the specified resource.
         */
        public function show($id)
        {
            $order = Order::where('id', $id)->first();
            $order_detail = OrderDetail::where('order_id',$order->id)->get();
            $user_data = User::where('id', $order->user_id)->first();

            // Tambahkan kode ini
            foreach ($order_detail as $item) {
                $checkin_date = Carbon::parse($item->checkin_date);
                $checkout_date = Carbon::parse($item->checkout_date);
                $item->number_of_nights = $checkin_date->diffInDays($checkout_date);
            }

            return view('user.order_details', compact('order', 'user_data', 'order_detail'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            // Mengambil data order berdasarkan ID
        $order = Order::findOrFail($id);

        // Menghapus data order
        $order->delete();

        // Redirect ke halaman index order
        return redirect()->route('admin.order.order_index')
                        ->with('success','Order deleted successfully');
            $order = Order::where('id', $id)->first();
            $order->delete();

            return redirect()->route('order.index')->with('error', 'Successfully deleted');
        }
        
    }

    