<?php

namespace Enniel\AmiHook;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param  Router  $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes.
     *
     * @return void
     */
    public function all()
    {
        $this->router->get('webhooks', 'WebhookController@all');
        $this->router->post('webhooks', 'WebhookController@store');
        $this->router->put('webhooks/{webhook_id}', 'WebhookController@update');
        $this->router->delete('webhooks/{webhook_id}', 'WebhookController@destroy');
        $this->router->get('webhooks/events', 'WebhookEventsController@all');
    }
}
