<?php
// jSON URL which should be requested
$json_url = '38.108.74.36/ulu.php';

if (isset($_GET["IP"]))
{
        $IP=$_GET["IP"];
}
else
{

        $IP="1.1.1.8";
}



// jSON String for request
$arr= array();
$arr[]  = array('VER'=> "1.0", 'IP'=>$IP);

$json_string = json_encode($arr);
$ch = curl_init($json_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_string))
);

$result = curl_exec($ch);
curl_close($ch);
if (!$result)
{
        print("Montreal Back end not reachable, print \"NA\" for graph, and .. if you notice this first, tell Tamaani!");
        exit;
}

var_dump($result);
$mv = json_decode($result,true);
if (!$mv)
{
        print("not a json response, did you get the URL correct?");
        // IE: Treat this as a possible JK coder failure, until proven otherwise
        exit;
}
print("<br/>");
var_dump($mv);
print("<br/>");
print("<br/>");
var_dump($mv["STATUS"]);
print("<br/>");

if (isset($mv["STATUS"]))
{
        switch($mv["STATUS"])
        {
                case "200":
                // process normally, it's fine
                        print("Status: ".$mv["STATUS"]);
                        print(" - ".$mv["STATUSTEXT"]);
                        print("<br/>");
                        print("Modem: ".$mv["MODEM"]);
                        print("<br/>");
                        print("Monthly bw IN: ".$mv["MBWIN"]);
                        print("<br/>");
                        print("Monthly BW OUT: ".$mv["MBWOUT"]);
                        print("<br/>");
                        print("Today BW IN: ".$mv["TBWIN"]);
                        print("<br/>");
                        print("Today BW OUT: ".$mv["TBWOUT"]);
                        print("<br/>");
                        print("Max Allowed: ".$mv["MAX"]);
                        print("<br/>");
                        print("Plan: ".$mv["PLAN"]);
                        print("<br/>");
                        break;
                case "400":
                case "401":
                case "501":
                        // a programmer needs to be involved, this is a permanent requesting error
                        print("Status: ".$mv["STATUS"]." - ".$mv["STATUSTEXT"]);
                        break;
                case "203":
                        // print zeroes, and a message saying tracking not currently available
                        break;
                case "404":
                        // normal - this user isn't a tamaani user
                        print "This space for displaying bandwidth when visiting with a Tamaani modem";
                        break;
                case 503:
                        // temporary error
                        print "Bandwidth tracking currently unavailable";
                        break;
                default:
                        // local error.. unknown response code treat as NA, but call Tamaani :)
                        break;
        } // end switch statement
}
else // STATUS not defined
{
        print("Status code missing from response, aborting!");
}
print("</br>HURRAYS!!</br>");