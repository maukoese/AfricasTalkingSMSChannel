<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use AfricasTalking\SDK\AfricasTalking;

class AfricasTalkingSMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toText($notifiable);

        // Send notification to the $notifiable instance...
        $username = env('AT_USERNAME', 'sandbox');
        $apiKey   = env('AT_PASSWORD', 'sandbox');
        $AT       = new AfricasTalking($username, $apiKey);

        $sms      = $AT->sms();
        try {
            $response = $this->sms->send([
                'to'      => $notification->to,
                'message' => $message
            ]);

            $codes = [
                100 => "Processed",
                101 => "Sent",
                102 => "Queued",
                401 => "RiskHold",
                402 => "InvalidSenderId",
                403 => "InvalidPhoneNumber",
                404 => "UnsupportedNumberType",
                405 => "InsufficientBalance",
                406 => "UserInBlacklist",
                407 => "CouldNotRoute",
                500 => "InternalServerError",
                501 => "GatewayError",
                502 => "RejectedByGateway"
            ];

            // {
            //     "SMSMessageData": {
            //         "Message": "Sent to 1/1 Total Cost: KES 0.8000",
            //         "Recipients": [{
            //             "statusCode": 101,
            //             "number": "+254711XXXYYY",
            //             "status": "Success",
            //             "cost": "KES 0.8000",
            //             "messageId": "ATPid_SampleTxnId123"
            //         }]
            //     }
            // }


            if (!isset($response["SMSMessageData"])) {
                throw CouldNotSendNotification::serviceRespondedWithAnError($th->getMessage());
            }
        } catch (\Throwable $th) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($th->getMessage());
        }
    }
}
