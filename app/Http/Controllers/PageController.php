<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use Illuminate\Http\Request;
use GuzzleHttp;
use Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestContactMail;

class PageController extends Controller
{
    public function index()
    {
        $data['meta_title'] = 'Master Settlement Agreement Lawsuit | Get Compensation for Wildfire Damages';
        $data['meta_description'] = 'If you’ve suffered property damage, injuries, or financial losses due to a master settlement agreement, you may be entitled to compensation. Get a free case evaluation today. No fees unless you win.';
        return view('home');
    }

    public function termsCondition()
    {
        $data['meta_title'] = 'Privacy Policy';
        $data['meta_description'] = 'Privacy Policy';
        return view('terms-and-condition');
    }

    public function privacyPolicy()
    {
        $data['meta_title'] = 'Terms & Conditions';
        $data['meta_description'] = 'Terms & Conditions';
        return view('privacy-and-policy');
    }

    public function msaPrivacyRights()
    {
        $data['meta_title'] = 'Master Settlement  Agreement Privacy Rights';
        $data['meta_description'] = 'Master Settlement  Agreement Privacy Rights';
        return view('master-settlement-agreement-privacy-and-policy');
    }

    function getOriginalClientIp(Request $request = null): string
    {
        $request = $request ?? request();
        $xForwardedFor = $request->header('x-forwarded-for');
        if (empty($xForwardedFor)) {
            // Si está vacío, tome la IP del request.
            $ip = $request->ip();
        } else {
            // Si no, viene de API gateway y se transforma para usar.
            $ips = is_array($xForwardedFor) ? $xForwardedFor : explode(', ', $xForwardedFor);
            $ip = $ips[0];
        }
        return $ip;
    }

    public function storeInquiry(InquiryRequest $request)
    {
        /*$client = new Google_Client();
        $client->setApplicationName('Google Sheets');
        $client->setHttpClient(new \GuzzleHttp\Client([
            'verify' => true,
        ]));
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig(public_path('depo-prova-2bcc47a67153.json')); // Path to JSON file
        $client->setAccessType('offline');

        $service = new Google_Service_Sheets($client);*/

        // Google Sheet ID and range
        /*$spreadsheetId = config('settings.sheet_id'); // Replace with your Google Sheet ID
        $range = 'Sheet1'; // Replace 'Sheet1' with the name of your sheet*/

        // Prepare data to append (mapping to your column headings)

        /*$body = new \Google_Service_Sheets_ValueRange([
            'values' => $values,
        ]);*/

        // Append data to the sheet
        /*$params = [
            'valueInputOption' => 'RAW', // Data input option
        ];*/

        try {
            $allRequest = $request->all();

            if(!isset($allRequest['bot']) || !empty($allRequest['bot_capture'])){
                return back()->with('error', 'Bot captured, wrong form data submit, please try again.');
            }
            if(isset($allRequest['bot']) && !empty($allRequest['bot'])){
                if($allRequest['bot'] != "bot"){
                    return back()->with('error', 'Bot captured, wrong form data submit, please try again.');
                }
            }

            $requestApi = new GuzzleHttp\Client(["verify" => false]);

            $request_param['fname'] = $request->first_name;
            $request_param['lname'] = $request->last_name;
            $request_param['phone'] = $request->phone;
            $request_param['email'] = $request->email;
            // $request_param['RideshareVictim'] = $request->rideshare_victim;
            $request_param['IPAddress'] = $this->getOriginalClientIp();
            $request_param['UsedDepoProvera'] = $request->used_depo_provera;
            $request_param['t_id'] = $request->xxTrustedFormCertUrl;
            $request_param['VendorLeadId'] = $request->xxTrustedFormToken;


            $request_param['xxTrustedFormToken'] = $request->xxTrustedFormToken;
            $request_param['xxTrustedFormCertUrl'] = $request->xxTrustedFormCertUrl;
            $request_param['xxTrustedFormPingUrl'] = $request->xxTrustedFormPingUrl;

            Mail::to(config('settings.to_email'))->send(new RequestContactMail($request_param));

            // $contact_request = $requestApi->request('POST', "https://nlcr.cagsys.com/leadPost.php?cid=55&fid=3168", [
            //     'form_params' => $request_param
            // ]);

            // if ($contact_request->getStatusCode() == 200 || $contact_request->getStatusCode() == 201) {
            //     $request_param['xxTrustedFormToken'] = $request->xxTrustedFormToken;
            //     $request_param['xxTrustedFormCertUrl'] = $request->xxTrustedFormCertUrl;
            //     $request_param['xxTrustedFormPingUrl'] = $request->xxTrustedFormPingUrl;
            //     Mail::to(config('settings.to_email'))->send(new RequestContactMail($request_param));
            //     $contents = (string) $contact_request->getBody();
            //     Log::error($contents);
            //     Log::error("Success Lead Sent On Email");
            // } else {
            //     $page_response = json_decode((string)$contact_request->getBody(), true);
            //     Log::error("Error for data post");
            //     Log::error($request_param);
            //     Log::error($page_response);
            // }

            return redirect()->route('thank-you')->with('success', 'Thank you for your time to fill this form, our representative will connect with you asap.');
        } catch (\Exception $e) {
            Log::error($e);
            Log::error($request->all());
            return back()->with('error', 'Something wen\'t wront, please try again. ');
        }
    }

    public function thankYou()
    {
        $data['meta_title'] = 'Thank You';
        $data['meta_description'] = 'Thank You';
        return view('thank-you');
    }
}
