<pre>
    <?php

    if (getenv('HTTP_X_FORWARDED_FOR')) {
        $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
        $ipaddress = getenv('REMOTE_ADDR');
        echo "Your Proxy IP address is : " . $pipaddress . "(via $ipaddress)";
    } else {
        $ipaddress = getenv('REMOTE_ADDR');
        echo "Your IP address is : $ipaddress";
    }
    echo '<br>';
    $country = getenv('GEOIP_COUNTRY_NAME');
   echo "Your country : $country";
   
    echo $_SERVER['SERVER_NAME'] . '<br>';

    echo $_SERVER['REMOTE_ADDR'] . '<br>';
    echo gethostbyaddr($_SERVER['REMOTE_ADDR']) . '<br>';

    function getip() {
        if (isSet($_SERVER)) {
            if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        return $realip;
    }

    print_r(getip());
    ?>
</pre>