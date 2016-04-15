<?php

class VerifyHandler
{
    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default('user_email','user_password');
        _response(verify_email_password($params['user_email'], $params['user_password']));
    }
}