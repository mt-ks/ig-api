<?php

namespace IgApi\Request;

use IgApi\Instagram;
use IgApi\Utils\Encryption;

class Registration
{
    private Instagram $ig;
    public function __construct(Instagram $ig)
    {
        $this->ig = $ig;
        $this->ig->zrToken();
        $this->ig->qeSync();
    }

    public function suggestUsername($email,$name){
        return $this->ig->request('accounts/username_suggestions/')
            ->addPost('phone_id',$this->ig->settings->info->getPhoneId())
            ->addPost('guid',$this->ig->settings->info->getUuid())
            ->addPost('name',$name)
            ->addPost('email',$email)
            ->addPost('waterfall_id',$this->ig->settings->info->getUuid())
            ->execute()
            ->getDecodedResponse();
    }

    public function sendVerifyEmail($email){
        return $this->ig->request('accounts/send_verify_email/')
            ->addPost('phone_id',$this->ig->settings->info->getPhoneId())
            ->addPost('guid',$this->ig->settings->info->getUuid())
            ->addPost('device_id',$this->ig->settings->info->getDeviceId())
            ->addPost('email',$email)
            ->addPost('waterfall_id',$this->ig->settings->info->getUuid())
            ->addPost('auto_confirm_only','false')
            ->execute()
            ->getDecodedResponse();
    }

    public function checkConfirmation($code,$email){
        return $this->ig->request('accounts/check_confirmation_code/')
            ->addPost('code',$code)
            ->addPost('device_id',$this->ig->settings->info->getDeviceId())
            ->addPost('email',$email)
            ->addPost('waterfall_id',$this->ig->settings->info->getUuid())
            ->execute()
            ->getDecodedResponse();
    }

    public function register($email,$firstName,$signupCode){
        return $this->ig->request('accounts/create/')
            ->addPost('adid',$this->ig->settings->info->getAdvertisingId())
            ->addPost('day',rand(1,25))
            ->addPost('device_id',$this->ig->settings->info->getDeviceId())
            ->addPost('do_not_auto_login_if_credentials_match','true')
            ->addPost('email',$email)
            ->addPost('enc_password',Encryption::generate_password_enc($this->ig->password,$this->ig->settings->info->getPublicKey(),$this->ig->settings->info->getPublicKeyId()))
            ->addPost('first_name',$firstName)
            ->addPost('force_sign_up_code',$signupCode)
            ->addPost('guid',$this->ig->settings->info->getUuid())
            ->addPost('is_secondary_account_creation','false')
            ->addPost('jazoest',Encryption::generateJazoest($this->ig->settings->info->getPhoneId()))
            ->addPost('month',rand(1,12))
            ->addPost('one_tap_opt_in','true')
            ->addPost('phone_id',$this->ig->settings->info->getPhoneId())
            ->addPost('qs_stamp','')
            ->addPost('sn_nonce',base64_encode($email.'|'.(time()+440).'|'.$this->ig->username.'|'.$this->ig->password))
            ->addPost('sn_result','API_ERROR:+class+X.A16:7: ')
            ->addPost('suggestedUsername','')
            ->addPost('tos_version','row')
            ->addPost('username',$this->ig->username)
            ->addPost('waterfall_id',$this->ig->settings->info->getUuid())
            ->addPost('year',rand(1993,2002))
            ->addPost('_uuid',$this->ig->settings->info->getUuid())
            ->execute()
            ->getDecodedResponse();
    }

}