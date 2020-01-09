namespace App\Notifications;

use App\Channels\Messages\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\SMSChannel;
use App\Order;


class OrderProcessed extends Notification
{
  use Queueable;


  public $order;
  
  public function __construct(Order $order)
  {
    $this->order = $order;
  }
  
  public function via($notifiable)
  {
    return [SMSChannel::class];
  }
  
  public function toText($notifiable)
  {
    $orderUrl = url("/orders/{$this->order->id}");
    $company = 'Acme';
    $deliveryDate = $this->order->created_at->addDays(4)->toFormattedDateString();


    return (new SMSMessage)
        ->content("Your {$company} order of {$this->order->name} has shipped and should be delivered on {$deliveryDate}. Details: {$orderUrl}");
  }
}
