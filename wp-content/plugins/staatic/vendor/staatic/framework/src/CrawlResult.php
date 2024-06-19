<?php

namespace Staatic\Framework;

use Staatic\Vendor\GuzzleHttp\Exception\RequestException;
use Staatic\Vendor\GuzzleHttp\Exception\TransferException;
use Staatic\Vendor\Psr\Http\Message\ResponseInterface;
use Staatic\Vendor\Psr\Http\Message\UriInterface;
final class CrawlResult
{
    /**
     * @var UriInterface
     */
    private $url;
    /**
     * @var UriInterface
     */
    private $transformedUrl;
    /**
     * @var UriInterface
     */
    private $normalizedUrl;
    /**
     * @var ResponseInterface|null
     */
    private $response;
    /**
     * @var UriInterface|null
     */
    private $foundOnUrl;
    private function __construct(UriInterface $url, UriInterface $transformedUrl, UriInterface $normalizedUrl, $response, $foundOnUrl = null)
    {
        $this->url = $url;
        $this->transformedUrl = $transformedUrl;
        $this->normalizedUrl = $normalizedUrl;
        $this->response = $response;
        $this->foundOnUrl = $foundOnUrl;
    }
    public static function fromFulfilledCrawlRequest(UriInterface $url, UriInterface $transformedUrl, UriInterface $normalizedUrl, ResponseInterface $response, $foundOnUrl = null) : self
    {
        return new static($url, $transformedUrl, $normalizedUrl, $response, $foundOnUrl);
    }
    public static function fromRejectedCrawlRequest(UriInterface $url, UriInterface $transformedUrl, UriInterface $normalizedUrl, TransferException $transferException, $foundOnUrl = null) : self
    {
        $response = null;
        if ($transferException instanceof RequestException) {
            $response = $transferException->getResponse();
        }
        return new static($url, $transformedUrl, $normalizedUrl, $response, $foundOnUrl);
    }
    public function url() : UriInterface
    {
        return $this->url;
    }
    public function transformedUrl() : UriInterface
    {
        return $this->transformedUrl;
    }
    public function normalizedUrl() : UriInterface
    {
        return $this->normalizedUrl;
    }
    public function response()
    {
        return $this->response;
    }
    public function foundOnUrl()
    {
        return $this->foundOnUrl;
    }
}
