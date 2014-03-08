<?php
$mode = getParam('mode');
$employeeId = get('employeeId');
$userName = get('userName');
$userType = get('userType');
$designationId = get('designationId');
$designationName = get('designationName');
$companyId = get('companyId');
$companyCode = get('cCode');
$companyName = get('companyName');
$roleId = get('roleId');
$nextApprovalId = get('nextApprovalId');

function safe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
    return $data;
}

function safe_b64decode($string) {
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function encodeSearchId($searchId) {
    if (!$searchId) {
        return false;
    }
    global $encrypKey;
    $text = $searchId;
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $encrypKey, $text, MCRYPT_MODE_ECB, $iv);
    return trim(safe_b64encode($crypttext));
}

function decodeSearchId($encodedSearchId) {
    if (!$encodedSearchId) {
        return false;
    }
    global $encrypKey;
    $crypttext = safe_b64decode($encodedSearchId);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $encrypKey, $crypttext, MCRYPT_MODE_ECB, $iv);
    return trim($decrypttext);
}

function authenticate($userName) {

    if (strstr($_SERVER['SCRIPT_NAME'], 'login.php'))
        return;
    if (array_key_exists('logout', $_GET)) {
        logout();
        echo "<script>location.replace('../common/index.php');</script>";
        showLoginDialog();
        return;
    }
    if ($userName)
        return;

    $userSupplied = isset($_SERVER['PHP_AUTH_USER']) || !isEmpty($userName);
    if (!$userSupplied) {
        //echo "dddddddddddddddddddddd";
        showLoginDialog();
        return;
    }

    if (!login())
        die();
}

function login() {
    $username = null;
    if (array_key_exists('PHP_AUTH_USER', $_SERVER))
        $username = $_SERVER['PHP_AUTH_USER'];
    if (isEmpty($username))
        $username = getParam('username');
    $pwd = null;
    if (array_key_exists('PHP_AUTH_PW', $_SERVER))
        $pwd = $_SERVER['PHP_AUTH_PW'];
    if (isEmpty($pwd))
        $pwd = getParam('password');

    $password = md5($pwd);
    $Company = getParam('company');

    $escaped_password = escape_string($password);
    $sql = "SELECT e.RoleId, e.DesignationId, e.NextApprovalId,
            e.EmployeeId, d.`Name` AS 'dName', c.CompanyID, c.`Code`,
             c.`Name` AS cName
            FROM user_table AS ut
            INNER JOIN employee AS e ON e.EmployeeId=ut.EmployeeId
            LEFT JOIN designation d ON d.DesignationId=e.DesignationId
            LEFT JOIN company c ON c.CompanyID=e.CompanyId
            WHERE UserName='$username' AND `Password`='$escaped_password' AND c.`Code`='$Company'";
    $user = find($sql);

    if (!$user) {
        echo "<script>location.replace('../common/index.php');</script>";
    } else {
        set('userType', $user->RoleId);
        set('designationId', $user->DesignationId);
        set('userName', $username);
        set('employeeId', $user->EmployeeId);
        set('companyId', $user->CompanyID);
        set('companyName', "$user->cName");
        set('roleId', "$user->RoleId");
        set('nextApprovalId', $user->NextApprovalId);
        set('cCode', $user->Code);
    }

    $remoteHost = $_SERVER['REMOTE_ADDR'];


    query("insert into user_session (username, logintime, remote_host) values ('$username', NOW(), '$remoteHost')");

    echo "<script>location.replace('../index/index.php');</script>";
}

function query($sql) {
    global $mysqli;

    $q = $mysqli->query($sql) or die($sql);

    return $q;
}

function rs2array($sql) {
    $result_sql = query($sql);
    $result = array();
    while ($row = $result_sql->fetch_row()) {
        $result[] = $row;
    }
    return $result;
}

function dbLink() {
    global $mysqli;

    $q = $mysqli;

    return $q;
}

function insertLastId() {
    global $mysqli;

    $id = mysqli_insert_id($mysqli);

    return $id;
}

function findValue($sql, $default = null) {
    $rs = query($sql);
    $row = $rs->fetch_array();
    if ($row == null)
        return $default;
    if ($row[0] == null)
        return $default;

    return $row[0];
}

function saveTable($array) {
    $field = '';
    $fieldValue = '';
    $i = 0;
    foreach ($array as $key => $value) {
        if ($i == 0) {
            $table = $key;
            $primaryKey = $value;
        } elseif ($i == 1) {
            $searchId = $key;
            $userId = $value;
        } else {
            $field.=$key . ', ';
            $val = getParam("$value");
            $fieldValue.="'$val', ";
        }
        $i++;
    }

    $field.='CreatedBy, CreatedDate';
    $fieldValue.="'$userId', NOW()";
    echo $sql = "INSERT INTO $table ($field) VALUES($fieldValue)";
    try {
        query($sql);
    } catch (PDOException $e) {
        echo "Error " . $e->errorInfo();
    }
}

function updateTable($array) {
    $field = '';
    $update = '';
    $fieldValue = '';
    $i = 0;
    foreach ($array as $key => $value) {
        if ($i == 0) {
            $table = $key;
            $primaryKey = $value;
        } elseif ($i == 1) {
            $searchId = $key;
            $userId = $value;
        } else {
            $field = $key;
            $val = $_POST[$value];
            $fieldValue = "'$val', ";
            $update.="$field" . '=' . "$fieldValue";
        }
        $i++;
    }

    $field.='ModifiedBy, ModifiedDate';
    $sql = "UPDATE $table SET $update ModifiedBy='$userId', ModifiedDate=NOW() WHERE $primaryKey='$searchId'";
    query($sql);
}

function deleteTable($array) {
    $field = '';
    $update = '';
    $fieldValue = '';
    $i = 0;
    foreach ($array as $key => $value) {
        if ($i == 0) {
            $table = $key;
            $primaryKey = $value;
        } elseif ($i == 1) {
            $searchId = $key;
            $userId = $value;
        }
        $i++;
    }

    $fieldValue.="'$userId', NOW()";
    $sql = "DELETE FROM $table WHERE $primaryKey='$searchId'";
    query($sql);
}

function hours2minutes($hours) {
    $hours = strtok($hours, ":.");
    $minutes = strtok(":.");
    return $hours * 60 + $minutes;
}

function minutes2hours($minutes) {
    $hours = floor($minutes / 60);
    $minutes = $minutes - $hours * 60;
    return sprintf("%02d:%02d", $hours, $minutes);
}

function isEmpty($str) {
    return (strlen(trim($str)) == 0) || ($str == "null");
}

function escape($string) {
    $string = htmlspecialchars($string);
    if (get_magic_quotes_runtime())
        $string = stripslashes($string);
    return @mysql_real_escape_string($string);
}

#-#escape()

function getParam($name, $default = null) {
    global $mysqli;
    if (array_key_exists($name, $_REQUEST)) {
        $param = $_REQUEST[$name];

        if ($name == 'searchId') {
            global $encrypKey;
            $param = decodeSearchId($param, $encrypKey);
        } else {
            if (is_string($param)) {
                $param = $mysqli->real_escape_string($param);
            } else {
                $param = $_REQUEST[$name];
            }
            //$param = $_REQUEST[$name];
            if ($default != null && isEmpty($param)) {
                return $default;
            }
        }

        return $param;
    } else
        return $default;
}

function num_fields($rs) {
    return mysql_num_fields($rs);
}

function buttonRow($buttons) {
    echo "<table class='buttonrow'>";
    echo "<tr>";
    for ($i = 0; $i < count($buttons); $i++) {
        echo "<td>";
        echo $buttons[$i];
        echo "</td>";
    }
    echo "</tr>\n";
    echo "</table>";
}

function button($caption, $name, $class = null, $url = null, $accesskey = null) {

    $type = "submit";
    if ($class == null)
        $class = 'button';
    if ($url != null)
        $type = "button";
    echo "<button type=$type name='$name' class='$class' value='$caption'";
    if ($url != null)
        echo "onClick=\"window.location.href='$url'\"";
    if ($accesskey != null)
        echo "accesskey='$accesskey'";
    echo ">$caption</button>";
}

function newButton($url = null) {
    return button("New", "new", '', $url);
}

function saveButton() {
    return button("Save", "save", 'button');
}

function searchButton() {
    return button("Search", "search", 'button');
}

function deleteButton() {
    return button("Delete", "delete", 'button');
}

function paramInput($name) {
    echo "<input type='text' ";
    echo "name=$name ";
    echo "value='" . getParam("$name") . "' ";
    echo "/>";
}

function onChange($onChange) {
    return "ajaxLoader('$onChange.php?val='+this.value+'', '$onChange', '<img src=../public/images/loading.gif />');";
}

//Boosttrap validation
function comboBox($name, $data, $selectedValue, $allowNull, $class = null, $validation = null, $onChangeFunction = null) {

    $onChange = $onChangeFunction == '' ? '' : "$onChangeFunction";
    ?>
    <select name='<?php echo $name; ?>' id='<?php echo $name; ?>' class='<?php echo $class; ?>' <?php echo $validation; ?> onChange= "<?php echo $onChange; ?>"  

            <?php
            if (array_key_exists('readonly', $_REQUEST))
                echo "disabled=true ";
            echo ">\n";
            if ($allowNull)
                echo "<option></option>";
            for ($j = 0; $j < count($data); $j++) {
                $option = $data[$j];
                if (count($option) > 3)
                    $label = $option[1] . ' - ' . $option[2] . ' - ' . $option[3];
                else if (count($option) > 2)
                    $label = $option[1] . ' - ' . $option[2];
                else if (count($option) > 1)
                    $label = $option[1];
                else
                    $label = $option[0]; echo "<option value='$option[0]' ";
                if ($option[0] == $selectedValue)
                    echo "selected";
                echo ">$label</option>";
            }
            echo "</select>";
        }

        function parseDate($datestr) {
            if (isEmpty($datestr))
                return null;
            if (strlen($datestr) == 10) {
                if (strstr($datestr, '-') === FALSE) {
                    return $datestr;
                }
                if (DATE_PATTERN == 'Y-m-d') {
                    $year = strtok($datestr, '-');
                    $month = strtok('-');
                    $day = strtok('-');
                    $date = mktime(0, 0, 0, $month, $day, $year);
                    return $date;
                }
            }
            return strtotime($datestr);
        }

        function formatDate($date) {
            if ($date == null)
                return "";
            $date = 0 + $date;
            return date(DATE_PATTERN, $date);
        }

        function parseTime($hhmm) {
            $hh = strtok($hhmm, ":.,");
            $mm = strtok(":.,");
            if (isEmpty($mm) && strlen($hhmm) == 4) {
                $hh = substr($hhmm, 0, 2);
                $mm = substr($hhmm, 2, 2);
            } else {
                if ($mm == '5') {
                    $mm = 30;
                }
            }
            return $hh * 60 + $mm;
        }

        function formatTime($minutes) {
            $hh = floor($minutes / 60);
            $mm = $minutes - $hh * 60;
            if (strlen($hh) == 1)
                $hh = "0" . $hh;
            if (strlen($mm) == 1)
                $mm = "0" . $mm;
            return $hh . ":" . $mm;
        }

        function formatDatetime($date) {
            return formatDate($date) . ' ' . date('H:i', $date);
        }

        function bddate($date) {
            if (($date != "") && ($date != "0000-00-00")) {
                list($Y, $M, $D) = explode("-", $date);
                $date = '';
                $date = date("d-M-Y", mktime(0, 0, 0, $M, $D, $Y));
                return $date; //25-02-2011
            }
        }

        function mkdatetime($date, $minutes, $seconds = 0) {
            $year = date("Y", $date);
            $month = date("m", $date);
            $day = date("d", $date);
            $hour = floor($minutes / 60);
            $minute = $minutes - $hour * 60;
            return mktime($hour, $minute, $seconds, $month, $day, $year);
        }

        function addDay($date, $diff = 1) {
            $year = date("Y", $date);
            $month = date("m", $date);
            $day = date("d", $date);
            $hour = date("H", $date);
            $minute = date("i", $date);
            return mktime($hour, $minute, 0, $month, $day + $diff, $year);
        }

        function addTime($date, $type, $diff = 1) {
            $year = date("Y", $date);
            $month = date("m", $date);
            $day = date("d", $date);
            $hour = date("H", $date);
            $minute = date("i", $date);
            if ($type == TYPE_HOURS)
                $hour += $diff;
            else if ($type == TYPE_DAYS)
                $day += $diff;
            else if ($type == TYPE_WEEKS)
                $day += $diff * 7;
            else if ($type == TYPE_MONTHS)
                $month += $diff;
            else if ($type == TYPE_YEARS)
                $year += $diff;
            return mktime($hour, $minute, 0, $month, $day, $year);
        }

        function roundTime($date, $type) {
            $year = date("Y", $date);
            $month = date("m", $date);
            $day = date("d", $date);
            $hour = date("H", $date);
            $minute = date("i", $date);
            if ($type == TYPE_HOURS)
                $minute = 0;
            else if ($type == TYPE_DAYS) {
                $minute = 0;
                $hour = 0;
            } else if ($type == TYPE_WEEKS) {
                return strtotime("last Sunday", $date);
            } else if ($type == TYPE_MONTHS) {
                $minute = 0;
                $hour = 0;
                $day = 1;
            }
            return mktime($hour, $minute, 0, $month, $day, $year);
        }

        function getYear($date) {
            return date("Y", $date);
        }

        function getYears($date) {
            return date("d-m-Y", $date);
        }

        function getAge($birthday) {
            list($year, $month, $day) = explode("-", $birthday);
            $year_diff = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff = date("d") - $day;
            if ($month_diff < 0)
                $year_diff--;
            elseif (($month_diff == 0) && ($day_diff < 0))
                $year_diff--;
            return $year_diff;
        }

        function dayDiff($date1, $date2) {
            return round(($date1 - $date2) / 24 / 3600);
        }

        function isSearch() {
            return array_key_exists("search", $_GET);
        }

        function isSave() {
            return array_key_exists("save", $_POST);
        }

        function isDelete() {
            return array_key_exists("delete", $_POST);
        }

        function isClear() {
            return array_key_exists("clear", $_POST);
        }

        function isNew() {
            if (!array_key_exists("new", $_POST))
                return false;
            return $_POST['new'] == "1";
        }

        function newbox() {
            if (getParam("action") == "new") {
                echo "<input type=hidden name=new value='1'/>";
            }
        }

        function datebox($id, $value = null) {
            if (strstr($value, '-') === false)
                $value = formatDate($value);
            echo "<input type='text' id='$id' name='$id' value='$value' size='12' ";
            if (array_key_exists('readonly', $_REQUEST))
                echo "onKeyPress='return false;' ";
            else
                echo "onKeyPress='return onDateKeyPress(event, this);' ";
            echo ">";
            echo "<img id='$id" . "_button' src='../include/jscalendar/img.gif'/>";
            if (!array_key_exists('readonly', $_REQUEST)) {
                echo "<script>\n";
                echo "Calendar.setup(\n";
                echo "{\n";
                echo "  inputField: '$id',\n";
                echo "  ifFormat: '" . DATE_PATTERN_MYSQL . "',\n";
                echo "  button: '$id" . "_button'\n";
                echo "}\n";
                echo ");\n";
                echo "</script>\n";
                $label = $id;
                addValidator("validateDate('" . tr($label) . "', document.postform.$id)");
                hidden("old_$id", $value);
            }
        }

        function localdate($date) {
            list($Y, $M, $D) = explode("-", $date);
            $date = gmdate("d-m-Y", mktime(0, 0, 0, $M, $D, $Y));
            return $date;
        }

        function moneyBox($name, $value = null, $size = 10, $signed = false) {
            $signed = $signed ? "true" : "false";
            $length = $size + 3;
            echo "<input type=text name='$name' value='$value' size=$length class=moneybox ";
            if (array_key_exists('readonly', $_REQUEST))
                echo "onKeyPress='return false;' ";
            else
                echo "onKeyPress='return onMoneyKeyPress(event, this, $signed, $size);' ";
            echo "> ";
            hidden("old_$name", $value);
            $label = $name;
            addValidator("validateMoney('" . tr($label) . "', document.postform.$name, $signed, $size)");
        }

        function datetimebox($name) {
            datebox($name . "date");
            echo "&nbsp;";
            timebox($name . "time");
        }

        function getDateTimeParam($name, $defaultDate = null) {
            $date = getParam($name . "date");
            if (isEmpty($date))
                $date = $defaultDate;
            return $date . " " . getParam($name . "time");
        }

        function prepNull($str) {
            if ($str == null)
                return "null";
            return $str;
        }

        function formatMoney($amount) {
            $amount = round($amount, 2);
            return sprintf('%9.2f', $amount);
        }

        function deleteIcon($href) {
            echo "<a href='$href' onClick=\"javascript:conf=window.confirm('Delete the selected record?'); if(conf==false) { return false; }\">";
            image("delete.png");
            echo "</a>";
        }

        function editIcon($href) {
            echo "<a href='$href' onClick=\"javascript:conf=window.confirm('Edit the selected record?'); if(conf==false) { return false; }\">";
            image("edit.png");
            echo "</a> | ";
        }

        function viewIcon($href) {
            echo "<a href='$href'>";
            image("view.png");
            echo "</a> | ";
        }

        function deleteColumn($href) {
            echo "<td align=center>";
            deleteIcon($href);
            echo "</td>";
        }

        function hidden($name, $value) {
            echo "<input type=hidden name='$name' value='$value'/>";
        }

        class Dummy {

            function __get($name) {
                return null;
            }

        }

        function checkBox($name, $value, $text = '', $onChange = null, $tooltip = null) {
            if (!isEmpty($text))
                $text = tr($text);
            $checked = $value == 1 || $value ? 'checked' : '';
            echo "<input type=checkbox name='$name' value='1' $checked ";
            if (array_key_exists('readonly', $_REQUEST))
                echo "disabled=true ";
            else if ($onChange != null) {
                echo " onClick='$onChange' ";
            }
            if ($tooltip != null)
                echo " title='$tooltip' ";
            echo ">$text</input>";
            $value0 = $value ? 1 : '';
            hidden("old_$name", $value0);
        }

        function numberBox($name, $value, $signed = false, $precision = 10, $scale = 0, $mandatory = false) {
            $length = $scale + $precision;
            if ($precision > 0)
                $length++;
            $signed = $signed ? 'true' : 'false';
            echo "<input type=text name='$name' value='$value' size=$length class=numberbox ";
            echo "onKeyPress='return onNumberKeyPress(event, this, $signed, $precision, $scale);' ";
            echo ">";
            hidden("old_$name", $value);
            if ($scale > 0)
                addValidator("validateNumber('" . tr($name) . "', document.postform.$name, $signed, $precision, $scale)");
            if ($mandatory)
                addValidator("validateMandatory('" . tr($name) . "', document.postform.$name)");
        }

        function tx($functionname, $params) {
            begin();
            $ret = call_user_func_array($functionname, $params);
            commit();
            return $ret;
        }

        function getDescription($value, $list, $default = 'Unknown') {
            foreach ($list as $row) {
                if ($row[0] == $value)
                    return tr($row[1]);
            }
            return $default;
        }

        function image($name) {
            echo "<img src='../public/images/$name'/>";
        }

        function get($key) {
            if (isset($_SESSION[$key]))
                return $_SESSION[$key];
        }

        function getLanguage() {
            return $_SESSION['language'];
        }

        function tr($text) {
            if (!defined($text))
                return $text;
            return constant($text);
        }

        function etr($text) {
            echo tr($text);
        }

        function escape_string($str) {
            if ($str !== null) {
                $str = str_replace(array('\\', '\''), array('\\\\', '\\\''), $str);
                $str = "$str";
            } else {
                $str = "null";
            }
            return $str;
        }

        function logout() {
            session_destroy();
        }

        function runScript($filename) {
            $fh = fopen($filename, 'r');
            $script = fread($fh, filesize($filename));
            fclose($fh);
            $sql = strtok($script, ";");
            while ($sql !== false) {
                if (strlen(trim($sql)) > 0)
                    sql($sql);
                $sql = strtok(";");
            }
        }

        function getMonthStepperDate() {
            $year = getParam("year");
            if (isEmpty($year))
                $year = date("Y");
            $month = getParam("month");
            if (isEmpty($month))
                $month = date("m");
            if (!isEmpty(getParam("prev")))
                $month--;
            if (!isEmpty(getParam("next")))
                $month++;
            $date = mktime(0, 0, 0, $month, 1, $year);
            return $date;
        }

        function monthStepper($date) {
            echo "<center>";
            echo "<table>";
            echo "<tr>";
            echo "<td><input type='submit' name='prev' value=' < '/></td>";
            echo "<td>" . date("Y M", $date) . "</td>";
            echo "<td><input type='submit' name='next' value=' > '/></td>";
            echo "</tr>";
            echo "</table>";
            echo "</center>";
            $year = date("Y", $date);
            $month = date("m", $date);
            hidden('year', $year);
            hidden('month', $month);
        }

        function getYearStepperDate() {
            $year = getParam("year");
            if (isEmpty($year))
                $year = date("Y");
            if (!isEmpty(getParam("prev")))
                $year--;
            if (!isEmpty(getParam("next")))
                $year++;
            $date = mktime(0, 0, 0, 1, 1, $year);

            return $date;
        }

        function getYearStepperDateFY() {
            $year = getParam("year");
            if (isEmpty($year))
                $year = date("Y");
            if (!isEmpty(getParam("prev")))
                $year--;
            if (!isEmpty(getParam("next")))
                $year++;
            $date = mktime(0, 0, 0, 7, 1, $year);

            return $date;
        }

        function yearStepper($date) {
            echo "<center>";
            echo "<table>";
            echo "<tr>";
            echo "<td><input type='submit' name='prev' value=' < '/></td>";
            echo "<td>" . date("Y", $date) . "</td>";
            echo "<td><input type='submit' name='next' value=' > '/></td>";
            echo "</tr>";
            echo "</table>";
            echo "</center>";
            $year = date("Y", $date);
            hidden('year', $year);
        }

        function set($key, $value) {
            $_SESSION[$key] = $value;
        }

        function getSessionAttribute($name) {
            if (array_key_exists($name, $_SESSION)) {
                return $_SESSION[$name];
            }
            return null;
        }

        function getRealm() {
            if (defined('DBNAME')) {
                $dbname = DBNAME;
            } else {
                $dbname = 'therp';
                if (array_key_exists('dbname', $_SESSION)) {
                    $dbname = $_SESSION['dbname'];
                }
                $dbname = getParam('dbname', $dbname);
            }
            return $dbname;
        }

        function defineIfNotDefined($name, $value) {
            if (defined($name))
                return;
            define($name, $value);
        }

        function showLoginDialog($mess = null) {
            $_SESSION['ORG_SCRIPT_NAME'] = $_SERVER['SCRIPT_NAME'];

            include '../common/index.php';
            include '../body/footer.php';
            die();
            //header("Location: ../common/index.php");
            //return false;
        }

        function getError($str) {
            if (substr($str, 0, 6) == "ERROR:")
                return substr($str, 6);
            return null;
        }

        function toggleClass($class) {
            if ($class == 'odd')
                return 'even';
            return 'odd';
        }

        function prepDate($str) {
            if (isEmpty($str))
                return "null";
            $str = parseDate($str);
            return "from_unixtime($str)";
        }

        function prepDateParam($param) {
            return prepDate(getParam($param));
        }

        function prepNumber($str) {
            if (isEmpty($str))
                return "null";
            $str = str_replace(',', '.', $str);
            return $str;
        }

        function prepNumberParam($param) {
            return prepNumber(getParam($param));
        }

        function prepMoney($str) {
            return prepNumber($str);
        }

        function prepMoneyParam($param) {
            return prepMoney(getParam($param));
        }

        function prepStringParam($param) {
            $value = getParam($param);
            if (isEmpty($value))
                return "null";
            return "'$value'";
        }

        function prepParam($name) {
            return prepNull(getParam($name));
        }

        function getDBName() {
            if (defined('DBNAME')) {
                if (DBNAME == 'alias') {
                    $path = $_SERVER['PHP_SELF'];
                    $alias = strtok($path, '/');
                    return $alias;
                } else if (DBNAME == 'subdomain') {
                    $path = $_SERVER['SERVER_NAME'];
                    $subdomain = strtok($path, '.');
                    return $subdomain;
                } else if (DBNAME == 'param') {
                    if (array_key_exists('dbname', $_SESSION))
                        $dbname = $_SESSION['dbname'];
                    else
                        $dbname = getParam('dbname');
                    return $dbname;
                }
                return DBNAME;
            }
            return "real";
        }

        function addValidator($validator) {
            $validators = array();
            if (array_key_exists('validators', $_REQUEST)) {
                $validators = $_REQUEST['validators'];
            }
            $validators[] = $validator;
            $_REQUEST['validators'] = $validators;
        }

        function Paging($link, $ct, $per_page) {
            global $totalPaggingPage;
            if ($ct == 0)
                return FALSE;
            $page = (int) getParam('page');
            $to = ($page * $per_page + $per_page) < $ct ? ($page * $per_page + $per_page) : $ct;
            echo "Showing Records <b>" . ($page * $per_page + 1) . " - " . $to . "</b>  of " . $ct . "    ";

            $cnt = (int) (($ct - 1) / $per_page);
            $totalPaggingPage = $cnt;

            if ($cnt == 0)
                return;
            if ($page > 0)
                echo "<a href=\"" . $link . "&page=" . ($page - 1) . "\"><img align='absmiddle' border='0' src=\"../public/images/left_arrow.png\"></a>&nbsp;&nbsp;&nbsp;";
            for ($i = $page - 5; $i < $page + 5; $i++) {
                if ($i == $page) {
                    echo "&nbsp;&nbsp;<b>[</b>" . ($i + 1) . "<b>]</b>&nbsp;&nbsp;";
                } elseif ($i >= 0 && $i <= $cnt) {
                    echo "&nbsp;&nbsp;<a style='color:#000000;font-weight:bold;text-decoration:none' href=\"" . $link . "&page=" . $i . "\">" . ($i + 1) . "</a>&nbsp;&nbsp;";
                }
            }//for

            if ($page < $cnt)
                echo "&nbsp;&nbsp;&nbsp;<a href=\"" . $link . "&page=" . ($page + 1) . "\"><img align='absmiddle' border='0' src=\"../public/images/right_arrow.png\"></a>";
        }

//===============to upload photo============
        function photoUploader($pathToSave, $fileName, $uploadType) {//photo uploader
            global $self, $pageName, $photoDirecTory, $adminName, $today, $now, $sql, $queryString, $queryStringCheck, $queryStringInsert, $forDB, $forFolder;

            if (($uploadType == "new") || ($uploadType == "")) {//new photo
                //-------generate random name for image------------------
                $sqlRand = "insert into bma_photo_id_generator (val) values ('1')";
                $resultRand = mysql_query($sqlRand) or die(mysql_error() . '------------sqlRand');
                if ($resultRand) {
                    $sqlMax = "select MAX(ID) as randomID from bma_photo_id_generator";
                    $resultMax = mysql_query($sqlMax) or die(mysql_error() . '------------sqlMax');
                    $showMax = mysql_fetch_array($resultMax);
                    $randomID = $showMax['randomID'];
                }
                $extention = explode('.', $fileName);
                $extention = $extention[count($extention) - 1];
                $forFolder = $pathToSave . $randomID . "." . $extention; //to rename file and save into folder
                $forDB = $randomID . "." . $extention; //to insert into db
            }//new photo
            else {//change photo
                $newFileName = explode('.', $uploadType);
                $newFileName = $newFileName[count($newFileName) - 2];
                $extention = explode('.', $fileName);
                $extention = $extention[count($extention) - 1];
                $newFileName = $newFileName . "." . $extention;

                $forFolder = $pathToSave . $newFileName; //to rename file and save into folder
                $forDB = $newFileName; //to insert into db
                //delete previous photo from folder
                if (is_file($pathToSave . $uploadType)) {
                    unlink($pathToSave . $uploadType);
                }
            }//change photo
        }

        function getDataUserLevel($userName) {
            $sql = "SELECT ul.UserLevelId,`Name`
            FROM user_level ul
            #INNER JOIN user_table ut ON ut.UserLevelId=ul.UserLevelId
            #WHERE ut.UserName='$userName' 
            ORDER BY `Name`";
            $result = query($sql);
            return $result;
        }

        function getUserLevelByUserId($userName) {
            $sql = "SELECT ul.MainId, ul.SubId 
            FROM user_table ut
            LEFT JOIN user_level ul ON ul.UserLevelId=ut.UserLevelId
            WHERE ut.UserName='$userName'";

            $result = find($sql);
            return $result;
        }

        function getMenuByMenuList($mainList) {
            $sql = "SELECT MenuId, `Name`, Links, Icon
            FROM sys_menu 
            WHERE `Group` like '%main%' AND `Show` = 1 AND MenuId IN($mainList) ORDER BY Sort";

            $result = query($sql);
            return $result;
        }

        function getMenu($userName) {
            $var = getUserLevelByUserId($userName);

            $mainList = $var->MainId;
            //$subList = $var->SubId;
            $main = getMenuByMenuList($mainList);
            while ($row = $main->fetch_object()) {

                echo "<li><a class='ajax-link' href='$row->Links'><i class='$row->Icon'></i><span class='hidden-tablet'> $row->Name</span></a></li>";
            }
        }

//encrypt
        function encrypt($text) {
            return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
        }

//decrypt
        function decrypt($text) {
            return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
        }

        function firstDayMonth() {
            return date("Y-m-d", strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
        }

        function lasDayMonth() {
            return date("Y-m-d", strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
        }

        function movePage($num, $url) {
            static $http = array(
                100 => "HTTP/1.1 100 Continue",
                101 => "HTTP/1.1 101 Switching Protocols",
                200 => "HTTP/1.1 200 OK",
                201 => "HTTP/1.1 201 Created",
                202 => "HTTP/1.1 202 Accepted",
                203 => "HTTP/1.1 203 Non-Authoritative Information",
                204 => "HTTP/1.1 204 No Content",
                205 => "HTTP/1.1 205 Reset Content",
                206 => "HTTP/1.1 206 Partial Content",
                300 => "HTTP/1.1 300 Multiple Choices",
                301 => "HTTP/1.1 301 Moved Permanently",
                302 => "HTTP/1.1 302 Found",
                303 => "HTTP/1.1 303 See Other",
                304 => "HTTP/1.1 304 Not Modified",
                305 => "HTTP/1.1 305 Use Proxy",
                307 => "HTTP/1.1 307 Temporary Redirect",
                400 => "HTTP/1.1 400 Bad Request",
                401 => "HTTP/1.1 401 Unauthorized",
                402 => "HTTP/1.1 402 Payment Required",
                403 => "HTTP/1.1 403 Forbidden",
                404 => "HTTP/1.1 404 Not Found",
                405 => "HTTP/1.1 405 Method Not Allowed",
                406 => "HTTP/1.1 406 Not Acceptable",
                407 => "HTTP/1.1 407 Proxy Authentication Required",
                408 => "HTTP/1.1 408 Request Time-out",
                409 => "HTTP/1.1 409 Conflict",
                410 => "HTTP/1.1 410 Gone",
                411 => "HTTP/1.1 411 Length Required",
                412 => "HTTP/1.1 412 Precondition Failed",
                413 => "HTTP/1.1 413 Request Entity Too Large",
                414 => "HTTP/1.1 414 Request-URI Too Large",
                415 => "HTTP/1.1 415 Unsupported Media Type",
                416 => "HTTP/1.1 416 Requested range not satisfiable",
                417 => "HTTP/1.1 417 Expectation Failed",
                500 => "HTTP/1.1 500 Internal Server Error",
                501 => "HTTP/1.1 501 Not Implemented",
                502 => "HTTP/1.1 502 Bad Gateway",
                503 => "HTTP/1.1 503 Service Unavailable",
                504 => "HTTP/1.1 504 Gateway Time-out"
            );
            header($http[$num]);
            header("Location: $url");
        }

//File Upload
        function SaveUploadFile($Request_Id, $Module_Name, $Attach_Title, $Attach_File_Path) {

            $user_name = get('user_name');

            if (isset($Attach_File_Path)) {

                foreach ($Attach_File_Path as $key => $val) {
                    $MaxFile_Attach_List_Id = NextId('file_attach_list', 'FILE_ATTACH_LIST_ID');
                    $insert_sql = "INSERT INTO file_attach_list(FILE_ATTACH_LIST_ID, REQUEST_ID, MODULE_NAME, ATTACH_TITTLE, ATTACH_FILE_PATH, CREATED_BY, CREATED_DATE) 
                        values('$MaxFile_Attach_List_Id', '$Request_Id', '$Module_Name', '$Attach_Title[$key]', '$Attach_File_Path[$key]', '$user_name', NOW() )";

                    sql($insert_sql);
                }
            }
        }

        function attachResult($search_id, $module) {
            $sql = "SELECT FILE_ATTACH_LIST_ID, ATTACH_TITTLE, ATTACH_FILE_PATH
                        FROM file_attach_list
                        WHERE REQUEST_ID = '$search_id' AND MODULE_NAME='$module'";
            $result = query($sql);

            return $result;
        }

        function FirstDayLastTwoMonth() {
            return date("Y-m-d", strtotime(date('m') - 2 . '/01/' . date('Y') . ' 00:00:00'));
        }

        function FirstDayLastThreeMonth() {
            return date("Y-m-d", strtotime(date('m') - 3 . '/01/' . date('Y') . ' 00:00:00'));
        }

        function convert_number_word($num) {
            list($num, $dec) = explode(".", $num);

            $output = "";

            if ($num{0} == "-") {
                $output = "negative ";
                $num = ltrim($num, "-");
            } else if ($num{0} == "+") {
                $output = "positive ";
                $num = ltrim($num, "+");
            }

            if ($num{0} == "0") {
                $output .= "zero";
            } else {
                $num = str_pad($num, 36, "0", STR_PAD_LEFT);
                $group = rtrim(chunk_split($num, 3, " "), " ");
                $groups = explode(" ", $group);

                $groups2 = array();
                foreach ($groups as $g)
                    $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});

                for ($z = 0; $z < count($groups2); $z++) {
                    if ($groups2[$z] != "") {
                        $output .= $groups2[$z] . convertGroup(11 - $z) . ($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1)) && $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");
                    }
                }

                $output = rtrim($output, ", ");
            }

            if ($dec > 0) {
                $output .= " point";
                for ($i = 0; $i < strlen($dec); $i++)
                    $output .= " " . convertDigit($dec{$i});
            }

            return $output;
        }

        function convertGroup($index) {
            switch ($index) {
                case 11: return " decillion";
                case 10: return " nonillion";
                case 9: return " octillion";
                case 8: return " septillion";
                case 7: return " sextillion";
                case 6: return " quintrillion";
                case 5: return " quadrillion";
                case 4: return " trillion";
                case 3: return " billion";
                case 2: return " million";
                case 1: return " thousand";
                case 0: return "";
            }
        }

        function convertThreeDigit($dig1, $dig2, $dig3) {
            $output = "";

            if ($dig1 == "0" && $dig2 == "0" && $dig3 == "0")
                return "";

            if ($dig1 != "0") {
                $output .= convertDigit($dig1) . " hundred";
                if ($dig2 != "0" || $dig3 != "0")
                    $output .= " and ";
            }

            if ($dig2 != "0")
                $output .= convertTwoDigit($dig2, $dig3);
            else if ($dig3 != "0")
                $output .= convertDigit($dig3);

            return $output;
        }

        function convertTwoDigit($dig1, $dig2) {
            if ($dig2 == "0") {
                switch ($dig1) {
                    case "1": return "ten";
                    case "2": return "twenty";
                    case "3": return "thirty";
                    case "4": return "forty";
                    case "5": return "fifty";
                    case "6": return "sixty";
                    case "7": return "seventy";
                    case "8": return "eighty";
                    case "9": return "ninety";
                }
            } else if ($dig1 == "1") {
                switch ($dig2) {
                    case "1": return "eleven";
                    case "2": return "twelve";
                    case "3": return "thirteen";
                    case "4": return "fourteen";
                    case "5": return "fifteen";
                    case "6": return "sixteen";
                    case "7": return "seventeen";
                    case "8": return "eighteen";
                    case "9": return "nineteen";
                }
            } else {
                $temp = convertDigit($dig2);
                switch ($dig1) {
                    case "2": return "twenty-$temp";
                    case "3": return "thirty-$temp";
                    case "4": return "forty-$temp";
                    case "5": return "fifty-$temp";
                    case "6": return "sixty-$temp";
                    case "7": return "seventy-$temp";
                    case "8": return "eighty-$temp";
                    case "9": return "ninety-$temp";
                }
            }
        }

        function convertDigit($digit) {
            switch ($digit) {
                case "0": return "zero";
                case "1": return "one";
                case "2": return "two";
                case "3": return "three";
                case "4": return "four";
                case "5": return "five";
                case "6": return "six";
                case "7": return "seven";
                case "8": return "eight";
                case "9": return "nine";
            }
        }

        function file_upload_html($multiple = NULL) { //true for multiple
            ?>
            <br>
        <h4>Attachment Title</h4>
        <?php
        if ($multiple != "") {
            echo "<button type='button' onclick='addFileMore();' class = 'btn btn-danger'>Add More</button>";
        }
        ?>
        <table class="productGrid" id="attachment_tab">
            <thead>
            <th width="20">SL.</th>
            <th>Attachment Tittle</th>
            <th>Attach File</th>
            <th width="50">Action</th>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td align='left'><input type='text' name='AttachmentDetails[]' class="required"/></td>
                    <td><input type='file' name='attachFile[]'/></td>
                    <td><div class='remove float-right' onClick='$(this).parent().parent().remove();'><img src='../public/images/delete.png'/></div></td>
                </tr>
            </tbody>
        </table>
        <?php
    }

    function file_upload_save($targetFolder, $req_id, $module) {
        //$targetFolder = '../documents/PR/'; // Relative to the root

        $AttachmentDetails = getParam('AttachmentDetails');

        if (!file_exists($targetFolder))
            mkdir($targetFolder);


        if (!empty($_FILES)) {

            foreach ($_FILES["attachFile"]["error"] as $key => $error) {
                $random_digit = rand(000000, 999999);

                $tempFile = $_FILES['attachFile']['tmp_name'][$key];
                $targetPath = $targetFolder; //$_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                // Validate the file type
                $fileTypes = array('jpg', 'jpeg', 'gif', 'pdf', 'png', 'xls', 'xlsx', 'doc', 'docx', 'ppt'); // File extensions
                $fileParts = pathinfo($_FILES['attachFile']['name'][$key]);

                if (in_array($fileParts['extension'], $fileTypes)) {

                    $file_name = basename($_FILES['attachFile']['name'][$key], '.' . $fileParts['extension']);
                    $file_name = str_replace(' ', '', $file_name);
                    $targetFile = $targetPath . $file_name . $random_digit . '.' . $fileParts['extension'];
                    move_uploaded_file($tempFile, $targetFile);
                    $path = $targetFolder . $file_name . $random_digit . '.' . $fileParts['extension'];

                    $sqlInsert = "INSERT INTO file_attach_list(REQUEST_ID, MODULE_NAME, ATTACH_TITTLE, ATTACH_FILE_PATH, CREATED_BY, CREATED_DATE)
                                    VALUES('$req_id', '$module', '$AttachmentDetails[$key]', '$path', '$employeeId', NOW())";
                    query($sqlInsert);
                }
            }
        }
    }

    function file_upload_single($targetFolder) {

        if (!file_exists($targetFolder))
            mkdir($targetFolder);


        if (!empty($_FILES)) {
            $random_digit = rand(000000, 999999);

            $tempFile = $_FILES['file_one']['tmp_name'];
            $targetPath = $targetFolder; //$_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'pdf', 'png', 'xls', 'xlsx', 'doc', 'docx', 'ppt'); // File extensions
            $fileParts = pathinfo($_FILES['file_one']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {

                $file_name = basename($_FILES['file_one']['name'], '.' . $fileParts['extension']);
                $file_name = str_replace(' ', '', $file_name);
                $targetFile = $targetPath . $file_name . $random_digit . '.' . $fileParts['extension'];
                move_uploaded_file($tempFile, $targetFile);
                $path = $targetFolder . $file_name . $random_digit . '.' . $fileParts['extension'];
            }
            return $path;
        }
    }

    function file_upload_edit($search_id, $module, $multiple = NULL) {
        ?>
        <br>
        <h3>Attachment List</h3>
        <?php
        if ($multiple != "") {
            echo "<button type='button' onclick='addFileMore();' class = 'btn btn-primary'>Add</button> <br/>";
        }
        ?>
        <table class="table table-striped table-bordered table-condensed" id="attachment_tab">
            <thead>
            <th width="30">SL.</th>
            <th align="left">Attachment Tittle</th>
            <th align="left">File</th>
            <th width="50">Action</th>
            </thead>
            <tbody>
                <?php
                $j = 1;
                $ResultAttachment = attachResult($search_id, $module);
                while ($rowAttachment = $ResultAttachment->fetch_object()) {
                    ?>
                    <tr>
                        <td><?php echo $j; ?>.</td>
                        <td><?php echo $rowAttachment->ATTACH_TITTLE; ?></td>
                        <td align="center"><a href='../PR/<?php echo $rowAttachment->ATTACH_FILE_PATH; ?>' target='_blank'>View </a></td>
                        <td><div class='remove float-right' id="<?php echo $rowAttachment->FILE_ATTACH_LIST_ID; ?>"><img src='../public/images/delete.png'/></div></td>
                    </tr>

                    <?php
                    $j++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    function file_upload_view($searchId, $module) {
        ?>
        <br>
        <h3>Attachment List</h3>
        <table class="productGrid" id="attachment_tab">
            <thead>
            <th width="20">SL.</th>
            <th align="left">Attachment Tittle</th>
            <th width="80" align="right">Action</th>
            </thead>
            <tbody>
                <?php
                $j = 1;
                $ResultAttachment = attachResult($searchId, $module);

                while ($rowAttachment = $ResultAttachment->fetch_object()) {
                    ?>
                    <tr>
                        <td><?php echo $j; ?>.</td>
                        <td><?php echo $rowAttachment->ATTACH_TITTLE; ?></td>
                        <td align="center"><a href='<?php echo $rowAttachment->ATTACH_FILE_PATH; ?>' target="_blank" class="">View </a></td>
                    </tr>
                    <?php
                    $j++;
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    function OrderNo($OrderId) {
        if (strlen($OrderId) == 1) {
            $OrderNo = date('Y') . '00000' . $OrderId;
        } elseif (strlen($OrderId) == 2) {
            $OrderNo = date('Y') . '0000' . $OrderId;
        } elseif (strlen($OrderId) == 3) {
            $OrderNo = date('Y') . '000' . $OrderId;
        } elseif (strlen($OrderId) == 4) {
            $OrderNo = date('Y') . '00' . $OrderId;
        } elseif (strlen($OrderId) == 5) {
            $OrderNo = date('Y') . '0' . $OrderId;
        } elseif (strlen($OrderId) == 6) {
            $OrderNo = date('Y') . $OrderId;
        }

        return $OrderNo;
    }
    ?>
