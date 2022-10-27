<?php

namespace App\Http\Controllers\API;

use App\Cars;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UseCarsController extends Controller
{

    public function exitFromCar(Guard $auth, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'car_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 422);
        }
        $carId = $input['car_id'];

        /** @var Cars $car */
        $car = Cars::find($carId);

        if (is_null($car)) {
            return response()->json('The car is not found!', 404);
        }

        if (!$car->user_id) {
            return response()->json('The car is empty', 403);
        }

        if ($auth->id() !== $car->user_id) {
            return response()->json('The car is occupied by another person!', 403);
        }

        $car->user_id = null;
        $car->save();
        return response()->json(null, 204);
    }

    public function useCar(Guard $auth, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'car_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 422);
        }
        $carId = $input['car_id'];

        /** @var Cars $car */
        $car = Cars::find($carId);

        if (is_null($car)) {
            return response()->json('The car is not found!', 404);
        }

        if ($car->user_id) {
            if ($auth->id() === $car->user_id) {
                return response()->json('The car is occupied by you!', 403);
            }
            return response()->json('The car is occupied!', 403);
        }

        $car->user_id = $auth->id();
        $car->save();
        return response()->json(null, 204);
    }
}
