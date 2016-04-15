<?php

class FeedbackStatusHandler
{
    function post($id)
    {
        $this->post_xhr($id);
    }

    function post_xhr($id)
    {
        _response(update_feedback_status($id));
    }
}