<?php


namespace IgApi\Exceptions;


use MClient\HttpInterface;
use Throwable;

class InstagramRequestException extends \Exception
{
    protected HttpInterface $execute;
    public function __construct(HttpInterface $execute,$message = "", $code = 0, Throwable $previous = null)
    {
        $this->execute = $execute;

        if (!$this->hasResponse())
        {
            $message = "Empty response!";
        }else{
            $message = $this->getResponseMessage();
        }

        if ($execute->hasCurlError())
        {
            $message = $execute->getCurlError();
        }

        parent::__construct($message, $code, $previous);

    }

    public function getErrorResponse($assoc = true)
    {
        if ($this->hasResponse()):
            return $this->execute->getDecodedResponse($assoc);
        endif;
        return $this->execute->getResponse();
    }

    public function getResponseMessage()
    {
        $data = $this->execute->getDecodedResponse();
        return $data["message"] ?? "";
    }

    public function getErrorType()
    {
        $data = $this->execute->getDecodedResponse();
        return $data["error_type"] ?? "";
    }

    /**
     * @return bool
     */
    public function hasResponse() : bool
    {
        return $this->execute->getResponse() !== '';
    }
}