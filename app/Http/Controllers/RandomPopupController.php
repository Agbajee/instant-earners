<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EarningHistory;
use Illuminate\Support\Facades\Log;

class RandomPopupController extends Controller
{
    public function showRandomPopup(Request $request)
    {
        $showPopup = false;

        if (!$request->user()->claimed_gift) {

            // $maxUserId = User::max('id');
            $maxUserId = 10000;

            // Create an array of all possible user IDs
            $allUserIds = range(1, $maxUserId);

            // Shuffle the array of user IDs
            shuffle($allUserIds);

            // Select the first 10 user IDs as random user IDs
            $randomUserIds = array_slice($allUserIds, 0, 10);

            if (in_array($request->user()->id, $randomUserIds)) {
                $showPopup = true;
            }

            // Log the random user IDs on the server-side
            // Log::info('Random user IDs:', $randomUserIds);

            return response()->json(['showPopup' => $showPopup]);
        }
    }

    public function claimGift(Request $request){

        if (!$request->user()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Users can only win an amount between 1 and 1000
        $randomAmount = mt_rand(1, 1000);

        // Update the user's balance
        $user = $request->user();
        $user->balance += $randomAmount;
        $user->claimed_gift = true;
        $user->save();

        $earning = new EarningHistory();
        $earning->user_id = $user->id;
        $earning->amount = $randomAmount;
        $earning->type = "Gift Claimed";
        $earning->save();

        return response()->json(['message' => 'Congratulations!', 'amount' => $randomAmount]);
    }
}
