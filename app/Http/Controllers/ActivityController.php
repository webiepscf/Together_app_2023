<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use GuzzleHttp\Client;
//use Illuminate\Pagination\LengthAwarePaginator;

class ActivityController extends Controller
{

    //     public function setCoords()
    //     {
    //         $client = new Client([
    //             'base_uri' => 'https://nominatim.openstreetmap.org/',
    //             'timeout'  => 2.0,
    //             'headers' => [
    //                 'User-Agent' => 'TogetherApp/1.0',
    //             ],
    //         ]);
    //         foreach ($activities = Activity::all() as $activity) {
    //             $response = $client->get('search', [
    //                 'query' => [
    //                     'street' => $activity->address,
    //                     'postalcode' => $activity->cp,
    //                     'city' => $activity->localite,
    //                     'country' => 'Belgium',
    //                     'format' => 'json',
    //                 ],
    //             ]);
    //             $responseData = json_decode($response->getBody(), true);
    // 
    //             if (!empty($responseData) && isset($responseData[0])) {
    //                 $activity->latitude = $responseData[0]['lat'];
    //                 $activity->longitude = $responseData[0]['lon'];
    //                 $activity->save();
    //             }
    //         }
    // 
    //         return $activities;
    //     }

    public function getActivitiesWithDistances(Request $request)
    {
        // Récupérez la position de l'utilisateur
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        $userRadius = $request->input('radius') | 100;

        // Je récupére les activités de la base de données, avec les liaisons aux autres tables
        $activities = Activity::with('user')->get();

        // Je parcoure les activités et j'ajoute un faux champ 'distance' à chaque activity
        foreach ($activities as $activity) {
            $activity->distance = $this->haversineGreatCircleDistance(
                $userLatitude,
                $userLongitude,
                $activity->latitude,
                $activity->longitude
            );
        }
        // Je retourne les activités qui sont dans le rayon de xkm
        return response()->json(
            $activities->values()->where('distance', '<', $userRadius)->all()
        );
    }

    public function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371
    ) {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
