<?php

namespace Enniel\AmiHook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookEventsController extends Controller
{
    /**
     * Get all of the available webhook events.
     *
     * @return Response
     */
    public function all(Request $request)
    {
        return collect(config('captain_hook.listeners', []))->transform(function ($key, $value) {
            return [
                'name' => $value,
                'event' => $key,
            ];
        })->values();
    }
}
