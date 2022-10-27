<?php

namespace App\Http\Controllers\API;

use App\Cars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{

    public function index()
    {
        $cars = Cars::all();
        return response()->json($cars->toArray(), 200);
    }

    public function show($id)
    {
        /** @var Cars $car */
        $car = Cars::find($id);

        if (is_null($car)) {
            return response()->json('The car is not found!', 404);
        }

        return response()->json($car->toArray(), 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|unique:cars|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 422);
        }

        $car = new Cars();
        $car->fill($validator->validated());
        $car->save();

        return response()->json($car->toArray(), 201, [
            'Location' => url("/api/cars/{$car->id}"),
        ]);
    }

    public function update(Request $request, Cars $car)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|unique:cars|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 422);
        }

        $car->fill($validator->validated());
        $car->save();

        return response()->json(null, 204);
    }

    public function destroy(Cars $car)
    {
        try {
            $car->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json(null, 204);
    }
}
