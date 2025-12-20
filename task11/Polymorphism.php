<?php
interface NotificationInterface{
    public function send($message);
}


class EmailNotification implements NotificationInterface{
    public function send($message){
        return "<br>Email sent : ".$message."<br>";
    }
    
}

class SMSNotification implements NotificationInterface{
    public function send($message){
        return "<br>SMS sent : ".$message."<br>";
    }
    
}

class PushNotification implements NotificationInterface{
    public function send($message){
        return "<br>Push sent : ".$message."<br>";
    }
}


class NotificationManager {
    public function notify(NotificationInterface $notification, $message){
        return $notification->send($message);
    }

    public function notifyAll(array $notifiers,$message){
        $output = "";
        foreach($notifiers as $notifier){
            $output .= $notifier->send($message);
        }
        return $output;
    }
}



?>