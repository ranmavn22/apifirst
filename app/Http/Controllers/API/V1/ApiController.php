<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Api_customer;

class ApiController extends Controller
{
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->all();
        $type = $data['account_type'];
        switch ($type) {
            case $type == Api_customer::ACCOUNT:
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:api_customers',
                    'account' => 'required|unique:api_customers',
                    'password' => 'required|min:8|max:20',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 401);
                }
                $result = Api_customer::registerUserAccount($data);
                if($result){
                    return $result;
                }
                break;
            case $type == Api_customer::FB:
                $access_token = $data['AccessToken'];
                $getDetail = "https://graph.facebook.com/v3.1/me?fields=id%2Caddress%2Cbirthday%2Cemail%2Cfirst_name%2Clast_name%2Cabout%2Cage_range%2Ccan_review_measurement_request%2Ceducation%2Cfavorite_athletes%2Cfavorite_teams%2Cgender%2Clocation%2Cname%2Cmiddle_name%2Cname_format%2Cmeeting_for%2Cquotes%2Creligion%2Csecurity_settings%2Clanguages%2Crelationship_status%2Cshort_name%2Csports%2Cwebsite%2Cwork%2Cphotos%7Bimages%7D%2Cfriendlists%2Cpicture%7Burl%2Cheight%2Cwidth%2Cis_silhouette%2Ccache_key%7D%2Cvideos&access_token=". $access_token;
                $response = file_get_contents($getDetail);
                $response = json_decode($response);
                break;
            case $type == Api_customer::TWITTER:

                break;
            case $type == Api_customer::INS:

                break;
            case $type == Api_customer::GOOGLE:

                break;
        }
    }
}
