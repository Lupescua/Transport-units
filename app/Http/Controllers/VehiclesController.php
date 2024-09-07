<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vehicle::all();
    }

    /**
     * Display a listing of the vehicles.
     */
    public function sort($type = null)
    {
        if ($type === 'truck' || $type === 'trailer') {
            return Vehicle::where('type', $type)->get();
        } else {
            // Return all vehicles if no type is provided
            return Vehicle::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request)
    {

         $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'model' => 'required|string',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'load_capacity' => 'required|numeric',
        ]);

        $vehicle = new Vehicle();
        $vehicle->name = $validatedData['name'];
        $vehicle->type = $validatedData['type'];
        $vehicle->model = $validatedData['model'];
        $vehicle->length = $validatedData['length'];
        $vehicle->width = $validatedData['width'];
        $vehicle->load_capacity = $validatedData['load_capacity'];
        $vehicle->save();

        return response()->json(['message' => 'Vehicle created successfully'], 201);
    }

    /**
     * Update the specified vehicle in storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        dump('Updating vehicle...',$request);
        $validatedData = $request->validate([
                'id' => 'required',
                'name' => 'required|string',
                'type' => 'required|string',
                'model' => 'required|string',
                'length' => 'required|numeric',
                'width' => 'required|numeric',
                'load_capacity' => 'required|numeric',
            ]);

        // Update the vehicle data
        $vehicle = Vehicle::find($id);
        $vehicle->update($validatedData);

        return response()->json(['message' => 'Vehicle updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Vehicle::findOrFail($id)->delete();
        return response()->json(['message' => 'Vehicle deleted successfully'], 200);
    }

}
