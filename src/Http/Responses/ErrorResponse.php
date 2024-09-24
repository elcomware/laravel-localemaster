<?php

namespace Elcomware\LocaleMaster\Http\Responses;

use Illuminate\Database\QueryException;

class ErrorResponse
{
    public static function createErrorResponse(array $input, object $object): \Illuminate\Http\JsonResponse
    {
        try {

            // Attempt to create the model instance
            $model = $object::create($input);

            // Return success response or the created model
            return response()->json(['success' => true, 'data' => $model], 201);

        } catch (QueryException $e) {
            // Handle database errors
            return response()->json(['success' => false, 'error' => 'Database error: '.$e->getMessage()], 500);
        } catch (\InvalidArgumentException $e) {
            // Handle invalid input
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            // Handle any other types of exceptions
            return response()->json(['success' => false, 'error' => 'An unexpected error occurred: '.$e->getMessage()], 500);
        }
    }
}
