<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../job/gmail.php';
class RecentIncidentsHandler
{
    function generateMessage()
    {
        $incidentUpdates = get_recent_incidents();
        $message = "";
        if (count($incidentUpdates) != 0) {
            $message .= "Crisis updates for the last hour:\n";

            foreach ($incidentUpdates as $i) {
                $message .= $i['COUNT(*)'].' '.$i['incident_type'];
                if ($i['COUNT(*)']>1) $message.='s';
                $message .= "\n";
            }
        }
        else {
            $message .= "No crisis update for the last hour.\n";
        }

        return $message;
    }

    function get()
    {
        $this->get_xhr();
    }

    function get_xhr() {
        $message = $this->generateMessage();
        $this->send_email($message);
    }

    function send_email($message){
        Gmail::sendMail($message);
    }
}