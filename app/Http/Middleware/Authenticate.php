<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\User;
class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
	 * Mapeia os gateways de origem para os seus respectivos handlers
	 *
	 * @var array
	 */
	protected $origin_handlers = [
		'merchantapp-gateway' => 'fromMerchantApp',
		'merchantpanel-gateway' => 'fromMerchantPanel',
		'userapp-gateway' => 'fromUserapp',
	];

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $origin_gateway = $request->header('X-Origin-Gateway');
		$auth_token = $request->header('Authorization');

		$method = $this->getOriginHandleMethod($origin_gateway);

		return $this->{$method}($request, $next);
    }

    /**
	 * Autentica o usuário merchant
	 *
	 * @param string $auth_token
	 * @return array|null
	 */
	private function handleMerchantAuth($auth_token)
	{
		$user_data = User::where('mobile_session_token', $auth_token)->first();

		if (!$user_data) {
			return null;
		}

		config([
			'app.auth.restrict' => true,
			'app.auth.field' => 'merchant_id',
			'app.auth.id' => $user_data['merchant_id'],
		]);

		return $user_data;
    }

    /**
	 * Autentica o usuário cliente
	 *
	 * @param string $auth_token
	 * @return array|null
	 */
	private function handleClientAuth($auth_token)
	{

	}

	/**
	 * Gerencia a requisição que vem do gerente de pedidos
	 *
	 * @param Request $request
	 * @param Closure $next
	 *
	 * @return Response
	 */
	private function fromMerchantApp($request, $next)
	{
		$user_data = $this->handleMerchantAuth($request->header('Authorization'));

		if (!$user_data) {
			return $this->unauthorized();
		}

		$request->merchant_user_data = $user_data;
		return $next($request);
	}

	/**
	 * Gerencia a requisição que vem do gerente do painel
	 *
	 * @param Request $request
	 * @param Closure $next
	 *
	 * @return Response
	 */
	private function fromMerchantPanel($request, $next)
	{
		$user_data = $this->handleMerchantAuth($auth_token);

		if (!$user_data) {
			return $this->unauthorized();
		}

		$request->merchant_user_data = $user_data;
		return $next($request);
	}

	/**
	 * Gerencia a requisição que vem do gerente do painel
	 *
	 * @param Request $request
	 * @param Closure $next
	 *
	 * @return Response
	 */
	private function fromUserapp($request, $next)
	{
		$user_data = $this->handleClientAuth($auth_token);

		if (!$user_data) {
			return $this->unauthorized();
		}

		$request->client_user_data = $user_data;
		return $next($request);
	}

    /**
	 * Obtém o nome do método que deve dar handle na requisição
	 *
	 * @param string $origin_gateway
	 *
	 * @return string
	 */
	private function getOriginHandleMethod($origin_gateway)
	{
		$origin_gateway = strtolower($origin_gateway);

		if (!isset($this->origin_handlers[$origin_gateway])) {
			return 'unauthorized';
		}

		return $this->origin_handlers[$origin_gateway];
    }

    /**
	 * Retorno padrão para requisições sem autorização
	 *
	 * @return Response
	 */
	private function unauthorized()
	{
		return response([
			'message' => 'Usuário não autenticado',
		], 401);
	}
}
