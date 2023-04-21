<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;


class VtuController extends Controller
{
    use SEOToolsTrait;

    public function getDataBundles(Request $request)
    {
        $network = $request->input('network');
        $apiKey = 'FLWSECK_TEST-a110eae48cc102ad7d0e0624ef6badeb-X';

        $client = new Client([
            'base_uri' => 'https://api.flutterwave.com/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ],
        ]);

        try {
            $response = $client->get('https://api.flutterwave.com/v3/bill-categories?data_bundle=1');

            $responseData = json_decode($response->getBody(), true);

            // Find the data bundles for the selected network
            $dataBundles = [];
            foreach ($responseData['data'] as $dataBundle) {
                // Log::info('Data bundle item:', $dataBundle);
                if (stripos($dataBundle['biller_name'], $network) === 0) {
                    $dataBundles[] = [
                        'value' => $dataBundle['biller_name'],
                        // 'text' => Str::lower($dataBundle['name']) . ' @ ' . $dataBundle['amount'] . 'MB',
                        'text' => $dataBundle['biller_name'],
                        'amount' => $dataBundle['amount'],
                    ];
                }
            }
    
            return response()->json($dataBundles);

        } catch (\Exception $e) {
            // Handle errors or failures
            return response()->json([
                'error' => 'Error fetching data bundles: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    public function vtu(){
        $data['pageTitle'] = "Convert Earnings";
        $data['gt'] = GeneralSettings::first();
        $this->seo()->setTitle('Recharge VTU');
        $this->seo()->opengraph()->setUrl(Url::current());
        return view('users.vtu', $data);
    }

    public function purchaseData(Request $request)
    {
        $bundleType = $request->input('bundle-type');
        $airtimeAmount = $request->input('airtime_amount');

        $phoneNumber = $request->input('phone_number');
        $dataPlan = $request->input('data_plan');
        $amount = $request->input('amount');
        $network = $request->input('network');
        Log::info('Type:', ['Bundle Type' => $bundleType]);

        // Deduct the cost of the data from the user's earnings
        // (Implement your logic here)



        $apiKey = 'FLWSECK_TEST-a110eae48cc102ad7d0e0624ef6badeb-X'; // Get the API key from the .env file
        $endPoint = 'https://api.flutterwave.com/v3/bills';

        $type = $bundleType === 'airtime' ? 'AIRTIME' : $dataPlan;
        $purchaseAmount = $bundleType === 'airtime' ? $airtimeAmount : $amount;
        Log::info('Type:', ['value' => $type]);
        Log::info('Request data:', $request->all());

        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $endPoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'country' => 'NG',
                'customer' => $phoneNumber,
                'amount' => $purchaseAmount,
                'type' => $type,
                'reference' => Str::random(12)
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpCode == 200) {
                $result = json_decode($response, true);
                // Update the user interface and database
                // (Implement your logic here)
                return response()->json(['message' => 'Purchase successful', 'data' => $result], 200);
            } else {
                $result = json_decode($response, true);
                Log::error('Error during purchase: ' . json_encode($result));

                // Handle errors or failures
                return response()->json(['message' => 'Purchase failed', 'error' => $result], 400);
            }

        } catch (\Exception $e) {
            Log::error('Server Error during purchase: ' . $e->getMessage());
            // Handle network or other errors
            return response()->json(['message' => 'Error during data purchase', 'error' => $e->getMessage()], 500);
        }
    }


}
