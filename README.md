# AfricasTalkingSMSChannel
Send Notifications via AT SMS on Laravel


## Usage

use App\Notifications\SampleNotification;


public function store(Request $request)
{
  $order = factory(\App\Order::class)->create();


  $request->user()->notify(new SampleNotification($order));


  return redirect()->route('home')->with('status', 'Order Placed!');
}
