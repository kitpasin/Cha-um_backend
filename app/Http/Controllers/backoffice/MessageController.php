<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\backoffice\BaseController as BaseController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends BaseController
{
    // Get messages
    public function index(Request $request)
    {
        $messages = Message::all();

        if ($messages) {
            return response()->json([
                "status" => 200,
                "message" => "Get messages successfully.",
                "data" => $messages
            ], 200);
        }

        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }
    
    // Create message
    public function createMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "subject" => "required",
            "message" => "required"
        ]);

        if ($validator->failed()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->messages()
            ], 422);
        }

        $message = Message::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message
        ]);

        if ($message) {
            return response()->json([
                "status" => 200,
                "message" => "Message created successfully."
            ], 200);
        }

        return response()->json([
            "status" => 422,
            "message" => "Something went wrong."
        ], 422);
    }

    // Update message
    public function updateMessage(Request $request, $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                "Status" => 404,
                "message" => "Message not found."
            ], 404);
        }
 
        $message->update($request->all());
 
        return response()->json([
            "status" => 200,
            "data" => $message
        ], 200);
    }

    // Delete message
    public function deleteMessage($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                "Status" => 404,
                "message" => "Message not found."
            ], 404);
        }
 
        $message->delete();
 
        return response()->json([
            "status" => 200,
            "message" => "Message deleted successfully."
        ], 200);
    }
}
