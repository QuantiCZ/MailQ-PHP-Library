<?php

namespace MailQ;

use MailQ\Exceptions\MailQException;
use MailQ\Exceptions\UnresolvedMxDomainException;
use MailQ\Exceptions\InvalidEmailAddressException;

class Connector
{

    private $apiKey;

    private $baseUrl;

    private $timeout = 0;

    private $connectionTimeout = 300;

    private static $instances = [];

    /**
     * Connector constructor.
     * @param $baseUrl
     * @param $apiKey
     * @param int $connectionTimeout
     * @param int $timeout
     */
    private function __construct($baseUrl, $apiKey, $connectionTimeout = 300, $timeout = 0)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->connectionTimeout = $connectionTimeout;
        $this->timeout = $timeout;
    }

    /**
     * @param $baseUrl
     * @param $apiKey
     * @param int $connectionTimeout
     * @param int $timeout
     * @return Connector
     */
    public static function getInstance($baseUrl, $apiKey, $connectionTimeout = 300, $timeout = 0)
    {
        $instanceId = join('|', [$baseUrl, $apiKey, $connectionTimeout, $timeout]);
        if (!isset(self::$instances[$instanceId])) {
            self::$instances[$instanceId] = new Connector($baseUrl, $apiKey, $connectionTimeout, $timeout);
        }
        return self::$instances[$instanceId];
    }

    /**
     *
     * @var array
     */
    private $headers;

    /**
     *
     * @param \MailQ\Request $request
     * @return \MailQ\Response
     */
    public function sendRequest(Request $request)
    {
        $ch = curl_init();
        $curlHeaders = $this->createCurlHeaders(array_merge($request->getHeaders(), $this->createDefaultHeaders()));
        $url = $this->baseUrl . '/companies/' . $request->getPath();
        if ($request->hasParameters()) {
            $url .= '?' . http_build_query($request->getParameters());
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, [$this, 'storeHeader']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        if ($request->hasContent()) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getContent());
        }
        if ($request->isPost()) {
            curl_setopt($ch, CURLOPT_POST, true);
        } elseif ($request->isDelete()) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, Request::HTTP_METHOD_DELETE);
        } elseif ($request->isPut()) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, Request::HTTP_METHOD_PUT);
        } elseif ($request->isPatch()) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, Request::HTTP_METHOD_PATCH);
        }
        $responseData = curl_exec($ch);
        $response = $this->createResponse($ch, $responseData);
        curl_close($ch);
        return $response;
    }

    /**
     *
     * @param $ch
     * @param string $response
     * @return Response
     */
    private function createResponse($ch, $response)
    {
        $responseData = new Response();
        $responseData->setHttpCode(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        if ($responseData->isOk()) {
            if (!$responseData->isNoContent()) {
                $responseData->setContent($response);
            }
        } else {
            $this->processError($responseData, $response);
        }
        $responseData->setHeaders($this->headers);
        $responseData->setHttpCode(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        return $responseData;
    }

    function processError(Response $responseData, $response)
    {
        switch ($responseData->getHttpCode()) {
            case 401:
                throw new MailQException("Invalid API key.", $responseData->getHttpCode());
            case 405:
                throw new MailQException("Method not allowed.", $responseData->getHttpCode());
            default:
                $this->handleDefaultException($responseData, $response);
        }
    }

    private function handleDefaultException(Response $responseData, $response)
    {
        $errorData = json_decode($response);
        if ($errorData) {
            if (isset($errorData->error)) {
                $this->createSpecificException($errorData->error);
            }
        } else {
            throw new MailQException("Unknown exception " . $responseData->getHttpCode(), $responseData->getHttpCode());
        }
    }

    private function createSpecificException($errorData)
    {
        // TODO change to resolving messages by errorCode
        if ($errorData->message === 'Could not resolve MX domain.') {
            throw new UnresolvedMxDomainException($errorData->message, isset($errorData->code) ? $errorData->code : 0);
        } else {
            if ($errorData->message === 'Invalid recipient email.') {
                throw new InvalidEmailAddressException($errorData->message, isset($errorData->code) ? $errorData->code : 0);
            } else {
                throw new MailQException($errorData->message . (isset($errorData->note) ? $errorData->note : ''), isset($errorData->code) ? $errorData->code : 0);
            }
        }
    }

    /**
     * Storing headers from curl
     * @param $ch
     * @param $str
     * @return int
     */
    function storeHeader($ch, $str)
    {
        $strex = explode(": ", $str);
        if (count($strex) == 2) {
            $this->headers[$strex[0]] = trim($strex[1]);
        } else {
            $this->headers[] = trim($str);
        }
        return strlen($str);
    }

    function createDefaultHeaders()
    {
        $headers = [
            "X-Api-Key" => $this->apiKey,
        ];
        $headers["Content-Type"] = "application/json";
        return $headers;
    }

    function createCurlHeaders($headers)
    {
        $curlHeaders = [];
        foreach ($headers as $headerName => $value) {
            $curlHeaders[] = $headerName . ": " . $value;
        }
        return $curlHeaders;
    }

}
