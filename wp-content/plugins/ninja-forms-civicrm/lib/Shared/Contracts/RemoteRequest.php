<?php 
namespace NinjaForms\CiviCrmShared\Contracts;

use NinjaForms\CiviCrmShared\Entities\HandledResponse;

/**
 * Make an HTTP request
 *
 */
interface RemoteRequest
{

	/**
	 * Set HTTP request URL
	 *
	 * @param string $url
	 * @return \SaturdayDrive\EmailCRM\AmoCrm\Handlers\RemoteRequest
	 */
	public function setUrl(string $url): RemoteRequest;
    
	/**
	 * Set an HTTP argument
	 *
	 * @param string $arg
	 * @param mixed $value
	 * @return RemoteRequest
	 */
	public function setHttpArg(string $arg, $value): RemoteRequest;

	/**
	 * Set an HTTP argument
	 *
	 * @param string $arg
	 * @param mixed $value
	 * @return RemoteRequest
	 */
	public function addQueryArg(string $arg, $value): RemoteRequest;

	/**
	 * Set HTTP request body
	 * @param mixed $body
	 * @return RemoteRequest
	 */
	public function setBody($body): RemoteRequest;

	/**
	 * Set an HTTP header parameter
     * 
     * @param string $arg
     * @param mixed $value
     * @return RemoteRequest
     */
	public function setHeaderParameter(string $arg, $value): RemoteRequest;

	/**
	 *
	 * @return HandledResponse
	 */
	public function handle():HandledResponse;

}
