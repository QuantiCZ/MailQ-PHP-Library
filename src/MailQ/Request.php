<?php

namespace MailQ;

use \Nette\Utils\Json;

class Request
{

    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_DELETE = 'DELETE';
    const HTTP_METHOD_PATCH = 'PATCH';

    /**
     *
     * @var string
     */
    private $method;

    /**
     *
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var
     */
    private $content;

    /**
     *
     * @var string
     */
    private $path;

    function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }


    function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    function setParameters($parameters)
    {
        if (is_iterable($parameters)) {
            foreach ($parameters as $key => $parameter) {
                if (is_bool($parameter)) {
                    $parameters[$key] = $parameter ? 'true' : 'false';
                }
            }

            $this->parameters = $parameters;
        }
    }

    function getHeaders()
    {
        if (isset($this->headers)) {
            return $this->headers;
        } else {
            return [];
        }

    }

    function hasContent()
    {
        return isset($this->content);
    }

    function hasParameters()
    {
        return isset($this->parameters) && count($this->parameters) > 0;
    }

    function getPath()
    {
        return $this->path;
    }

    function getContent()
    {
        return $this->content;
    }

    function setContent($content = null)
    {
        $this->content = $content;
    }

    function setContentAsEntity(Entities\BaseEntity $entity)
    {
        $this->content = Json::encode($entity->toArray());
    }

    function getParameters()
    {
        return $this->parameters;
    }


    function isPost()
    {
        return $this->method === self::HTTP_METHOD_POST;
    }

    function isPut()
    {
        return $this->method === self::HTTP_METHOD_PUT;
    }

    function isPatch()
    {
        return $this->method === self::HTTP_METHOD_PATCH;
    }

    function isDelete()
    {
        return $this->method === self::HTTP_METHOD_DELETE;
    }

    /**
     * @param $path
     * @param null $parameters
     * @param null $headers
     * @return Request
     */
    static function get($path, $parameters = null, $headers = null)
    {
        return self::createRequest(self::HTTP_METHOD_GET, $path, $parameters, $headers);
    }

    /**
     * @param $path
     * @param null $parameters
     * @param null $headers
     * @param Entities\BaseEntity|null $content
     * @return Request
     */
    static function post($path, $parameters = null, $headers = null, Entities\BaseEntity $content = null)
    {
        return self::createRequest(self::HTTP_METHOD_POST, $path, $parameters, $headers, $content);
    }

    /**
     * @param $path
     * @param null $parameters
     * @param null $headers
     * @param Entities\BaseEntity|null $content
     * @return Request
     */
    static function put($path, $parameters = null, $headers = null, Entities\BaseEntity $content = null)
    {
        return self::createRequest(self::HTTP_METHOD_PUT, $path, $parameters, $headers, $content);
    }

    /**
     * @param $path
     * @param null $parameters
     * @param null $headers
     * @param Entities\BaseEntity|null $content
     * @return Request
     */
    static function patch($path, $parameters = null, $headers = null, Entities\BaseEntity $content = null)
    {
        return self::createRequest(self::HTTP_METHOD_PATCH, $path, $parameters, $headers, $content);
    }

    /**
     * @param $path
     * @param null $parameters
     * @param null $headers
     * @return Request
     */
    static function delete($path, $parameters = null, $headers = null)
    {
        return self::createRequest(self::HTTP_METHOD_DELETE, $path, $headers, $parameters);
    }

    private static function createRequest($method, $path, $parameters = null, $headers = null, $content = null)
    {
        $request = new Request($method, $path);
        $request->setHeaders($headers);
        $request->setParameters($parameters);
        if ($content !== null) {
            if (is_string($content)) {
                $request->setContent($content);
            }
            else {
                $request->setContentAsEntity($content);
            }
        }
        return $request;
    }


}
