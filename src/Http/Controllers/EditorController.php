<?php

namespace NIQAHEditor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

use NIQAHEditor\Events\RequestSubmitted;

class EditorController extends Controller
{
    public function submit(Request $request)
    {
      
      if (!$request->ajax()) {
        return Response::json([
          'success' => false,
          'message' => 'Invalid request',
        ], 400);
      }

      
      $this->validate($request, [
        'version' => 'required|string',
        'activeComponents' => 'required|array',
        'action' => 'required|string'
      ]);
      
      // TODO:
      // 1. Validate activeComponents format
      // 2. Validate block format
      // 3. Validate version
      RequestSubmitted::dispatch(
        $request->all('version', 'activeComponents', 'action')
      );
      
      return Response::json([
        'success' => true,
        'message' => 'Request submitted successfully',
      ], 200);
    }
}