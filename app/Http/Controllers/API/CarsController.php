<?php

namespace App\Http\Controllers\API;

use App\Cars;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarsController extends BaseController
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'numeric|min:2|max:100',
        ]);

        $cars = Cars::query()->paginate($validator->validated()['limit']);

        $headers = [
            'X-Pagination-Total-Count' => $cars->total(),
            'X-Pagination-Current-Page' => $cars->currentPage(),
            'X-Pagination-Per-Page' => $cars->perPage(),
        ];

        return response()->json(CarResource::collection($cars), 200, $headers);
    }

    public function show($id)
    {
        /** @var Cars $car */
        $car = Cars::find($id);

        if (is_null($car)) {
            return response()->json(['message' => 'The car is not found!'], 404);
        }

        return response()->json(new CarResource($car), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:cars|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error!', 'errors' => $validator->errors()], 422);
        }

        $car = new Cars();
        $car->fill($validator->validated());
        $car->save();

        $headers = [
            'Location' => url("/api/cars/{$car->id}"),
        ];

        return response()->json(new CarResource($car), 201, $headers);
    }

    public function update(Request $request, $id)
    {
        /** @var Cars $car */
        $car = Cars::find($id);

        if (is_null($car)) {
            return response()->json(['message' => 'The car is not found!'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:cars|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error!', 'errors' => $validator->errors()], 422);
        }

        $car->fill($validator->validated());
        $car->save();

        return response()->json(null, 204);
    }

    public function destroy($id)
    {
        /** @var Cars $car */
        $car = Cars::find($id);

        if (is_null($car)) {
            return response()->json(['message' => 'The car is not found!'], 404);
        }

        try {
            $car->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(null, 204);
    }
}
