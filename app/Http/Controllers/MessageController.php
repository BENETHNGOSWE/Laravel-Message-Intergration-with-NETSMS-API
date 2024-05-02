<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function showSendMessageForm()
    {
        return view('send-message-form');
    }

  
    public function sendMessage(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $message = $request->input('message');
        $postData = [
            'from' => 'NEXTSMS',
            'to' => $phoneNumber,
            'text' => $message,
            'reference' => 'NEXTSMS',
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://messaging-service.co.tz/api/sms/v1/text/single',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => [
                'Authorization:Basic ' . base64_encode(env('SMS_API_KEY') . ':' . env('SMS_SECRET_KEY')),
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            CURLOPT_SSL_VERIFYPEER => false, 
        ]);
    
        
        $responses = curl_exec($curl);
        curl_close($curl);
    
       
        $response = json_decode($responses, true);
    
        if (isset($response['success']) && $response['success'] == false) {
            return redirect()->back()->with('error', 'Failed to send message. Please try again.');
        } else {
            if ($response['messages'][0]['status']['groupName'] == 'PENDING') {
                return redirect()->back()->with('success', 'Message sent successfully!');
            } else {
                // Failed to send message
                return redirect()->back()->with('error', 'Failed to send message. Please try again.');
            }
        }
    }
    
    
    
}
