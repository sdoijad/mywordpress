<?php

namespace NinjaForms\CiviCrmShared\Handlers;

use NinjaForms\CiviCrmShared\Contracts\RemoteRequest as ContractsRemoteRequest;
use NinjaForms\CiviCrmShared\Entities\HandledResponse;

/**
 * Make an HTTP request using wp_remote_request
 *
 */
class WpRemoteRequest implements ContractsRemoteRequest
{

	/**
	 * URL for request
	 * @var string
	 */
	protected $url = '';
	
	/**
	 * Optional headers to be sent
	 *
	 * Null default in case empty array is required (?)
	 * @var array|null
	 */
	protected $headers = null;
	
	/**
	 * HTTP settings for request
	 *
	 * @var array
	 * @see $allowedArgs
	 */
	protected $httpArgs = [];
	
	/**
	 * Query string requests as key-value pairs
	 * @var array
	 */
	protected $queryArgs = [];
	
	/**
	 * Body of request
	 *
	 * @var mixed|null
	 */
	protected $body = null;
	
	/**
	 * Allowed arguments that can be used in HTTP request
	 *
	 * @var array
	 */
	protected $allowedArgs = [
		'timeout', 'redirection', 'httpversion', 'sslverify', 'method'
	];
	
	/**
	 * Response from request
	 *
	 * @var HandledResponse
	 */
	protected $handledResponse;

	/**
	 * Make an HTTP request to return a response array
	 */
	public function __construct()
	{
		$this->setDefaultHttpArgs();
	}


	public function setUrl(string $url): ContractsRemoteRequest
	{
		$this->url = $url;
		return $this;
	}


	public function setHttpArg(string $arg, $value): ContractsRemoteRequest
	{

		if (in_array($arg, $this->allowedArgs)) {
			$this->httpArgs[$arg] = $value;
		}

		return $this;
	}


	public function addQueryArg(string $arg, $value): ContractsRemoteRequest
	{

		$this->queryArgs[$arg] = $value;

		return $this;
	}


	public function setBody($body): ContractsRemoteRequest
	{
		$this->body = $body;
		return $this;
	}

	public function setHeaderParameter($arg, $value): ContractsRemoteRequest
	{
		$this->headers[$arg] = $value;
		return $this;
	}

	protected function finalizeRequest()
	{
		if (!is_null($this->headers)) {
			$this->httpArgs['headers'] = $this->headers;
		}
		if (!is_null($this->body)) {
			$this->httpArgs['body'] = $this->body;
		}

		if (!empty($this->queryArgs)) {
			$this->url = add_query_arg($this->queryArgs, $this->url);
		}
	}
	/**
	 *
	 * @return HandledResponse
	 */
	public function handle():HandledResponse
	{
		$this->finalizeRequest();

				$this->handledResponse= new HandledResponse();
				
		$rawResponse = wp_remote_request($this->url, $this->httpArgs);

		if (is_wp_error($rawResponse)) {
			$this->handledResponse->setIsWpError(true);
			$this->handledResponse->setIsSuccessful(false);
			$this->handledResponse->setErrorMessages($rawResponse->get_error_messages());
		} else {
			$this->handledResponse->setResponseBody($rawResponse['body']);
		}

		$this->handledResponse->setTimestamp(time());

		return $this->handledResponse;
	}

	/**
	 * Set default arguments
	 */
	protected function setDefaultHttpArgs()
	{
		$this->httpArgs = [
			'timeout' => 45,
			'redirection' => 0,
			'httpversion' => '1.0',
			'sslverify' => true,
			'method' => 'GET'
		];
	}
}
