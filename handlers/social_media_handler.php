<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../job/gmail.php';

class SocialMediaHandler
{
    function generateMessage()
    {
        //$incidentUpdates = get_recent_incidents();
        $incidentUpdates = get_recent_incidents();

        $message = "";
        if (count($incidentUpdates) != 0) {
            $message .= "Crisis updates for the last 30 minutes:\n";

            foreach ($incidentUpdates as $i) {
                $message .= $i['COUNT(*)'].' '.$i['incident_type'];
                if ($i['COUNT(*)']>1) $message.='s';
                $message .= "\n";
            }
        }

        return $message;
    }

    function get()
    {
        $this->get_xhr();
    }

    function get_xhr()
    {
        $message = $this->generateMessage();
        if ($message != ""){
            $this->post_twitter($message);
            $this->post_fb($message);
        }
        else
        {
            _response('no update');
        }

    }

    function post_fb($message)
    {
        $fb = new Facebook\Facebook([
            'app_id' => '1015629591830583',
            'app_secret' => 'f9bc1e8c36edbbe1eafcb939cf8b4915',
            'default_graph_version' => 'v2.5',
        ]);

        $test_message = $message;

        $linkData = [
            'message' => $test_message,
        ];

        try {
            $response = $fb->post('/1048572268543375/feed', $linkData,
                '#YOUR_TOKEN#');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();

        echo 'Posted with id: ' . $graphNode['id'];
    }

    function post_twitter($message)
    {
        $settings = array(
            'oauth_access_token' => "#YOUR_TOKEN#",
            'oauth_access_token_secret' => "#YOUR_SECRET#",
            'consumer_key' => "#YOUR KEY#",
            'consumer_secret' => "#YOUR SECRET#"
        );

        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';

        $test_message = $message;
        if (strlen($test_message)>140) $test_message=substr($test_message,0,130);
        $postfields = array(
            'status' => $test_message
        );

        $twitter = new TwitterAPIExchange($settings);
        echo $twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postfields)
            ->performRequest();
    }
}