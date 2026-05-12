<?php

namespace NIQAHEditor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use NIQAHEditor\BlockComponentResolver;

class BlockComponentController extends Controller
{
    public function __invoke(Request $request)
    {

        if (
            ! $this->isValidIncomingRequest($request)
        ) {

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid request',
                ],
                400
            );
        }

        $validator = Validator::make(
            $request->all('version', 'activeComponents', 'action'),
            [
                'version' => 'required|string',
                'activeComponents' => 'required',
                'action' => 'required|string',
            ]
        );

        if (
            $validator->fails() && ! (new BlockComponentResolver)->isValid($request->input('activeComponents'))
        ) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid block component format',
                    'errors' => $validator->errors()->toArray(),
                ],
                400
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Validation ok',
                'errors' => [],
            ],
            200
        );
    }

    public function isValidIncomingRequest(Request $request): bool
    {
        // TODO:
        // 1. validate bot
        // 2. validate signature
        // 3. validate anti spam

        return $request->ajax();
    }
}
