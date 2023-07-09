<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use Illuminate\Http\Request;
use App\Models\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)
    {
        try {
            // Validate form
            $requestData = $request->validated();

            // Create a new transaction
            $transaction = new Transaction();
            $transaction->fill($requestData);

            $transaction->save();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Could not save transaction',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return Transaction::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Could not find transaction',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionStoreRequest $request, string $id)
    {
        try {
            // Validate form
            $requestData = $request->validated();

            $transaction = Transaction::findOrFail($id);

            // Update transaction
            $transaction->fill($requestData);
            $transaction->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Could not update transaction',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Could not delete transaction',
            ], 500);
        }
    }
}
