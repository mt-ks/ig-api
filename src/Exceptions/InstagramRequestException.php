<?php


namespace IgApi\Exceptions;


use IgApi\Model\ChallengeModel;
use IgApi\Model\TwoFactorResponse;
use MClient\HttpInterface;
use Throwable;

class InstagramRequestException extends \Exception
{
    protected HttpInterface $execute;
    public function __construct(HttpInterface $execute,$message = "", $code = 0, Throwable $previous = null)
    {

        $this->execute = $execute;

        if ($message === "")
        {
            if (!$this->hasResponse())
            {
                $message = "Empty response!";
            }else{
                $message = $this->getResponseMessage();
            }

            if ($execute->hasCurlError())
            {
                $message = $execute->getCurlErrorNo() . ' : ' . $execute->getCurlError();
            }
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

    public function isChallenge() : bool
    {
        if (!$this->hasResponse()) {
            return false;
        }
        $data = $this->getErrorResponse();
        return (($data["message"]) && $data["message"] === "challenge_required");
    }

    public function getChallengeData() : ?ChallengeModel
    {
        if (!$this->isChallenge()){
            return null;
        }
        return new ChallengeModel($this->getErrorResponse());
    }

    /**
     * @return bool
     */
    public function isTwoFactor() : bool
    {
        return ($this->hasResponse() && isset($this->getErrorResponse()["two_factor_required"]));
    }

    public function getTwoFactorData() : TwoFactorResponse
    {
        return new TwoFactorResponse($this->getErrorResponse());
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
