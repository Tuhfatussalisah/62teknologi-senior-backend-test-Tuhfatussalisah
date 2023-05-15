<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessModel;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class Business extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BusinessModel::all();
        $response = ApiFormatter::createApi(200, 'success', $data);
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $form = $request->all();

            $validator = Validator::make($form,
            [
                'location' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'term' => 'required',
                'radius' => 'required',
                'categories' => 'required',
                'locale' => 'required',
                'price' => 'required',
            ],
            [
                'location.required' => 'Location is required',
                'latitude.required' => 'Latitude is required',
                'longitude.required' => 'Longitude is required',
                'term.required' => 'Term is required',
                'radius.required' => 'Radius is required',
                'categories.required' => 'Categories is required',
                'locale.required' => 'Locale is required',
                'price.required' => 'Price is required',
            ]
            );

            if ($validator->fails()) {
                $response = APIFormatter::createApi(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }

            BusinessModel::create($form); //post process

            $response = APIFormatter::createApi(200, 'success', $form);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(400, $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try  {
            $data = BusinessModel::findorfail($id);
            $response = APIFormatter::createApi(200, 'success', $data);
            return response()->json($response);
        } catch (\Exception $e){
            $response = ApiFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $form = $request->all();

            $validator = Validator::make($form,
            [
                'location' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'term' => 'required',
                'radius' => 'required',
                'categories' => 'required',
                'locale' => 'required',
                'price' => 'required',
            ],
            [
                'location.required' => 'Location is required',
                'latitude.required' => 'Latitude is required',
                'longitude.required' => 'Longitude is required',
                'term.required' => 'Term is required',
                'radius.required' => 'Radius is required',
                'categories.required' => 'Categories is required',
                'locale.required' => 'Locale is required',
                'price.required' => 'Price is required',
            ]);

            if ($validator->fails()) {
                $response = APIFormatter::createApi(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }

            BusinessModel::where("business_id", $id)->update($form); //update process

            $response = APIFormatter::createApi(200, 'success', $form);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = APIFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = BusinessModel::findorfail($id);
            $data->delete();
            $response = ApiFormatter::createApi(200, 'success', $data);
            return response()->json($response);
        } catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000")
            $response = ApiFormatter::createApi(400, 'Cannot Delete this data because it is used in another table');
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createApi(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }
}
