<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use JWTAuth;
use Validator;
use Image;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Routing\Helpers;
use App\User;
use App\Invoice;
use App\Revenuehead;
use App\Mda;
use App\Worker;
use App\Postable;
use App\Subhead;
use App\Percentage;
use App\Tin;
use App\Igr;
use DB;
use App\Remittance;
use App\Collection;
use App\Ebillcollection;
use App\Remittancenotification;
use App\Invoicenotification;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use SoapBox\Formatter\Formatter;

class EbillNotificationController extends Controller
{
    public function index(Request $request)
    {
    	$jsonString = $request->getContent();
    	$formatter = Formatter::make($jsonString, Formatter::XML);
    	$json  = $formatter->toArray();

        $json_en = json_encode($json);

        //loging ebils request
        DB::table('ebilsnotificationlogs')->insert(
            ['log' => $json_en]
        );

         $json = $this->param_value($json);

    	//checking notification for collection
    	if (isset($json['tax'])) {

    		$res = $this->collection($json);
            return $res;

    	}

    	//checking notification for remittance
    	if (isset($json['Remittance'])) {
    		
    		$res = $this->remittance($json);
            return $res;
    	}

    	//checking notification for invoice
    	if (isset($json['Invoice'])) {
    		$res = $this->invoice($json);
            return $res;
    	}
    }

    /////////////////////////////////////////////////////////////////////////////////

    //collection api
    private function collection($param)
    {
    	 

    	    if (isset($param['collection_key'])) {
    	        $data['collection_key'] = $param['collection_key'];
    	    }

            if (isset($param['Tin'])) {
                $data['Tin'] = $param['Tin'];
            }

            if (isset($param['collection_type'])) {
                $data['collection_type'] = $param['collection_type'];
            }


            if (isset($param['tax'])) {
                $data['tax'] = $param['tax'];
            }


            if (isset($param['Tin'])) {
                $data['Tin'] = $param['Tin'];
            }

            if (isset($param['name'])) {
                $data['name'] = $param['name'];
            }

    	    if (isset($param['phone'])) {
    	        $data['phone'] = $param['phone'];
    	    }

    	    if (isset($param['mda'])) {
    	        $data['mda'] = $param['mda'];
    	    }

            if (isset($param['lga'])) {
                $data['mda'] = $param['lga'];
            }

    	    if (isset($param['subhead'])) {
    	        $data['subhead'] = $param['subhead'];
    	    }

    	    if (isset($param['period'])) {
    	        $data['period'] = $param['period'];
    	    }

    	    if (isset($param['amount'])) {
    	        $data['amount'] = $param['amount'];
    	    }

            if (isset($param['payer_id'])) {
                $data['payer_id'] = $param['payer_id'];
            }

            if (isset($param['mda_key'])) {
                $data['mda_key'] = $param['mda_key'];
            }

            if (isset($param['subhead_key'])) {
                $data['subhead_key'] = $param['subhead_key'];
            }

            if (isset($param['ercasBillerId'])) {
                $data['ercasBillerId'] = $param['ercasBillerId'];
            }

            if (isset($param['refcode'])) {
                $data['refcode'] = $param['refcode'];
            }

            if (isset($param['BillerID'])) {
                $data['BillerID'] = $param['BillerID'];
            }

            if (isset($param['SourceBankName'])) {
                $data['SourceBankName'] = $param['SourceBankName'];
            }

            if (isset($param['BillerName'])) {
                $data['BillerName'] = $param['BillerName'];
            }
    	
        $data['igr_id'] = $this->igr_id($data['ercasBillerId']);

        $data['mda_id'] = $this->mda_id($data['mda_key']);
        $data['subhead_id'] = $this->subhead_id($data['subhead_key']);

    	$date_info = explode("/", $data['period']);
    	$data['start_date'] = $date_info[0];
    	$data['end_date'] = $date_info[1];
    	$data['SessionID'] = $param['SessionID'];
    	$data['SourceBankCode'] = $param['SourceBankCode'];
    	$data['DestinationBankCode'] = $param['DestinationBankCode'];

        if ($data['tax'] == 1) {
            $data['payer_id'] = $data['Tin'];
        }


        if ($collection = Collection::create($data)) {

            //insert ebills collection
            $ebillcollection = Ebillcollection::create($data);

            //getting percentage
            $percentage_data = $this->get_percentage($data['subhead_id'], $collection);

            //gov and agency percentage amount
            $data['agency_amount'] = $percentage_data['agency_amount'];
            $data['gov_amount'] = $percentage_data['gov_amount'];
            $data['collection_id'] = $collection->id;
            $data['amount'] = $collection->amount;
            $data['collected_at'] = $collection->created_at;

            //inserting percentage amount
            Percentage::create($data);

            $res = $this->success_message($data);
            return $res;
        }

        $message = "parameter missing unable to receive message";
        $res = $this->success_error($data, $message);
        return $res;
    }


    /////////////////////////////////////////////////////////////////////////////////

    //notification for remittance
    private function remittance($param)
    {

                if (isset($param['name'])) {
                    $data['name'] = $param['name'];
                }

                if (isset($param['phone'])) {
                    $data['phone'] = $param['phone'];
                }

                if (isset($param['mda'])) {
                    $data['mda'] = $param['mda'];
                }


                if (isset($param['amount'])) {
                    $data['amount'] = $param['amount'];
                }

                if (isset($param['mda_key'])) {
                    $data['mda_key'] = $param['mda_key'];
                }

                if (isset($param['Remittance'])) {
                    $data['remittance_key'] = $param['Remittance'];
                }

                if (isset($param['ercasBillerId'])) {
                    $data['ercasBillerId'] = $param['ercasBillerId'];
                }

                if (isset($param['refcode'])) {
                    $data['refcode'] = $param['refcode'];
                }

                if (isset($param['BillerID'])) {
                    $data['BillerID'] = $param['BillerID'];
                }

                if (isset($param['SourceBankName'])) {
                    $data['SourceBankName'] = $param['SourceBankName'];
                }

                if (isset($param['BillerName'])) {
                    $data['BillerName'] = $param['BillerName'];
                }
                

        $data['igr_id'] = $this->igr_id($data['ercasBillerId']);

        $data['mda_id'] = $this->mda_id($param['mda_key']);

    	$data['SessionID'] = $param['SessionID'];
    	$data['SourceBankCode'] = $param['SourceBankCode'];
    	$data['DestinationBankCode'] = $param['DestinationBankCode'];

    	//insert ebills remittance notification table
    	if ($ebillcollection = Remittancenotification::create($data)) {

    		if (! $remittance = Remittance::where("remittance_key", $data['remittance_key'])->first()) {

               $message = "Invalid remmittance key";
               $res = $this->success_error($data, $message);
               return $res;
            }

            //getting the current date time
            $date_time = date('Y-m-d H:i:s');

            //updating paid remittance
            $remittance->update(['remittance_status'=>1]);
            $remittance->remtted_date = $date_time;
    		$remittance->save();

            //getting all pos collection with remittance id
            $collections = Collection::where("remittance_id",$remittance->id)->get();

            //calculating pacentage base on gov collection
            foreach ($collections as $collection) {
                //getting percentage
                $percentage_data = $this->get_percentage($collection->subhead_id, $collection);

                //gov and agency percentage amount
                $data['subhead_id'] = $collection->subhead_id;
                $data['agency_amount'] = $percentage_data['agency_amount'];
                $data['gov_amount'] = $percentage_data['gov_amount'];
                $data['collection_id'] = $collection->id;
                $data['amount'] = $collection->amount;
                $data['collected_at'] = $collection->created_at;

                //inserting percentage amount
                Percentage::create($data);
            }


            $res = $this->success_message($data);
            return $res;
    	}

        $message = "Parameter missing";
        $res = $this->success_error($data,$message);
        return $res;
    }

    /////////////////////////////////////////////////////////////////////////////////
    //invoice notifcation
    private function invoice($param)
    {

        if (isset($param['name'])) {
            $data['name'] = $param['name'];
        }

        if (isset($param['phone'])) {
            $data['phone'] = $param['phone'];
        }

        if (isset($param['mda'])) {
            $data['mda'] = $param['mda'];
        }


        if (isset($param['amount'])) {
            $data['amount'] = $param['amount'];
        }

        if (isset($param['mda_key'])) {
            $data['mda_key'] = $param['mda_key'];
        }

        if (isset($param['subhead'])) {
            $data['subhead'] = $param['subhead'];
        }

        if (isset($param['mda'])) {
            $data['mda'] = $param['mda'];
        }

        if (isset($param['Invoice'])) {
            $data['invoice_key'] = $param['Invoice'];
        }

        if (isset($param['ercasBillerId'])) {
            $data['ercasBillerId'] = $param['ercasBillerId'];
        }

        if (isset($param['BillerID'])) {
            $data['BillerID'] = $param['BillerID'];
        }

        if (isset($param['SourceBankName'])) {
            $data['SourceBankName'] = $param['SourceBankName'];
        }

        if (isset($param['BillerName'])) {
            $data['BillerName'] = $param['BillerName'];
        }


        $data['igr_id'] = $this->igr_id($data['ercasBillerId']);
        

        $data['mda_id'] = $this->mda_id($param['mda_key']);
        $data['subhead_id'] = $this->subhead_id($param['subhead_key']);

    	$data['SessionID'] = $param['SessionID'];
    	$data['SourceBankCode'] = $param['SourceBankCode'];
    	$data['DestinationBankCode'] = $param['DestinationBankCode'];


    	//insert ebills remittance notification table
    	if ($invoice = Invoicenotification::create($data)) {

            if (! $invoice_result = Invoice::where("invoice_key", $data['invoice_key'])->first()) {
                
                $message ="Invalid invoice number";
                $res = $this->success_error($data, $message);
                return $res;
            }

            //updating remited invoice
            $invoice_result->invoice_status = 1;
            $invoice_result->save();
    		

            $res = $this->success_message($data);
            return $res;
    	}

        $message ="paramer missing";
        $res = $this->success_error($data, $message);
        return $res;
    }

    /////////////////////////////////////////////////////////////////////////////////

    //getting biller(IGR) serial id
    private function igr_id($igr_key)
    {
        if ($igr = Igr::where("igr_key",$igr_key)->first()) {
                   
            return $igr->id;
        }
    }

    //////////////////////////////////////////////////////////////////////////////////

    //getting mda id
    private function mda_id($mda_key)
    {
        if ($mda = Mda::where("mda_key",$mda_key)->first()) {
                # code...
            return $mda->id;
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////

    //getting mda name
    private function subhead_id($mda_key)
    {
        if ($mda = Subhead::where("subhead_key",$mda_key)->first()) {
                # code...
            return $mda->id;
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////

    //XML successful response
    private function success_message($data)
    {
        $data['messageCode'] = "00";
        $data['message'] = "Successfully recieved";

        $content = view('xml.notification', compact('data'));

        return response($content, 200)
                   ->header('Content-Type', 'application/xml'); 
    }

    /////////////////////////////////////////////////////////////////////////////////////

    //XML error response
    private function success_error($data, $message)
    {
        $data['messageCode'] = 401;
        $data['message'] = $message;
        
        $content = view('xml.notification_error', compact('data'));

        return response($content, 401)
            ->header('Content-Type', 'application/xml');
    }

    /////////////////////////////////////////////////////////////////////////////////////
    //geting array value
    private function param_value($param)
    {
        
        $data['BillerID'] = $param['BillerID'];
        $data['SessionID'] = $param['SessionID'];
        $data['SourceBankCode'] = $param['SourceBankCode'];
        $data['SourceBankName'] = $param['SourceBankName'];
        $data['DestinationBankCode'] = $param['DestinationBankCode'];
        $data['Amount'] = $param['Amount'];
        $data['BillerName'] = $param['BillerName'];

            for ($i=0; $i <count($param['Param']) ; $i++) { 

                if ($param['Param'][$i]['Key'] == "Refcode") {
                    $data['collection_key'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "collection_type") {
                    $data['collection_type'] = $param['Param'][$i]['Value'];
                }


                if ($param['Param'][$i]['Key'] == "tax") {
                    $data['tax'] = $param['Param'][$i]['Value'];
                }


                if ($param['Param'][$i]['Key'] == "Tin") {
                    $data['Tin'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "name") {
                    $data['name'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "phone") {
                    $data['phone'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "mda") {
                    $data['mda'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "lga") {
                    $data['lga'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "subhead") {
                    $data['subhead'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "period") {
                    $data['period'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "amount") {
                    $data['amount'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "payerid") {
                    $data['payer_id'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "mda_key") {
                    $data['mda_key'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "subhead_key") {
                    $data['subhead_key'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "Remittance") {
                    $data['Remittance'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "Invoice") {
                    $data['Invoice'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "ercasBillerId") {
                    $data['ercasBillerId'] = $param['Param'][$i]['Value'];
                }

                if ($param['Param'][$i]['Key'] == "refcode") {
                    $data['refcode'] = $param['Param'][$i]['Value'];
                }
            }


            return $data;
    }


    //getting gov and agency percentage
    private function get_percentage($subhead_id, $collection)
    {
        //getting subhead percentage
        $subhead_percentage = Subhead::where("id",$subhead_id)->first();

        //getting gov amount and agency amount if gov % > 0 and agency > 0
        if ($subhead_percentage->gov >= 0 && $subhead_percentage->agency > 0) {
            
            $data['gov_amount'] = $subhead_percentage->gov/100 * $collection->amount;
            $data['agency_amount'] = $subhead_percentage->agency/100 * $collection->amount;
        }

        //getting gov amount and agency amount if gov % = 0 and agency = 0
        if ($subhead_percentage->gov == 0 && $subhead_percentage->agency == 0) {

            $data['gov_amount'] = $subhead_percentage->gov/100 * $collection->amount;
            $data['agency_amount'] = $collection->amount;
        }

        //getting gov amount and agency amount if gov % > 0 and agency = 0
        if ($subhead_percentage->gov > 0 && $subhead_percentage->agency == 0) {
            $data['gov_amount'] = $subhead_percentage->gov/100 * $collection->amount;
            $data['agency_amount'] = $subhead_percentage->agency/100 * $collection->amount;
        }

        return $data;
    }
}
