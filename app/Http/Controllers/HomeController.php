<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\StoreCardRequest;
use App\Http\Resources\Home\HomeCardResource;
use App\Http\Resources\Home\HomeHeaderResource;
use App\Models\Home\HomeCard;
use App\Models\Home\HomeHeader;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeHeader()
    {
        return HomeHeaderResource::collection(HomeHeader::all());
    }

    public function homeCards()
    {
        return HomeCardResource::collection(HomeCard::all());
    }

    public function showHomeCard($id)
    {
        return HomeCardResource::make(HomeCard::findOrFail($id));
    }

    public function updateHomeCard(StoreCardRequest $request, $id)
    {
        $request->validated();

        $homeCard = HomeCard::findOrfail($id);

        $homeCard->title = $request->title;
        $homeCard->description = $request->description;

        $homeCard->save();

        return response()->json([
            'success' => true,
            'message' => 'Card updated successfully! :)'
        ]);
    }
}
