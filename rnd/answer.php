<?php
include '../lib/db-settings.php';
include '../body/header.php';

if (isSave()) {

    $array = array(
        'php_quiz   ' => ' QuizId',
        "$searchId" => "$employeeId",
        'Name' => "Name");
    //saveTable($array);
    $name = getParam('Name');
    $answer = getParam('answer');

    $name = htmlspecialchars($name);


    query("INSERT INTO php_quiz (Name, CreatedBy, CreatedDate) VALUES('$name', '14', NOW())");
    $id = insertLastId();

    foreach ($answer as $key => $value) {
        $answerEncoded = htmlspecialchars($answer[$key]);
        query("INSERT INTO php_quiz_details(QuizId, `Name`) VALUES('$id', '$answerEncoded')");
    }
    echo "<script>location.replace('answer.php')</script>";
}


$result = query("SELECT * FROM php_quiz");
?>

<script>
    function addMore() {
        var countTr = $('#quiz tbody tr').length;
        var sl = countTr + 1;
        $('#quiz tbody').append('<tr>\n\
            <td>' + sl + '.<td><textarea name="answer[]" style="width: 95%;"></textarea></td>\n\
            <td><div class="remove float-right" onClick="$(this).parent().parent().remove();"><img src="../public/images/delete.png"/></div>\n\
            </td>\n\
        </tr>');
    }
</script>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">New Employee</a>
            </h3>
        </div>
        <div class="box-content">
            <form method='POST' autocomplete="off">


                <table id="quiz" class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td width="20"></td>
                            <td>Quiz <textarea name='Name' style='width: 95%;'></textarea></td>   
                            <td></td>
                        </tr>
                        <tr>
                            <td width="20">1</td>
                            <td><textarea name='answer[]' style='width: 95%;'></textarea></td>   
                            <td><div class="remove float-right" onClick="$(this).parent().parent().remove();"><img src="../public/images/delete.png"/></div></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><textarea name='answer[]' style='width: 95%;'></textarea></td>   
                            <td><div class="remove float-right" onClick="$(this).parent().parent().remove();"><img src="../public/images/delete.png"/></div></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><textarea name='answer[]' style='width: 95%;'></textarea></td>   
                            <td><div class="remove float-right" onClick="$(this).parent().parent().remove();"><img src="../public/images/delete.png"/></div></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><textarea name='answer[]' style='width: 95%;'></textarea></td>   
                            <td><div class="remove float-right" onClick="$(this).parent().parent().remove();"><img src="../public/images/delete.png"/></div></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" name="save" class="btn btn-primary">
                    <i class="icon icon-white icon-save"></i> Save 
                </button>
                <button type='button' onclick='addMore();' class = 'btn btn-primary'>
                    <i class="icon icon-white icon-add"></i>Add</button>
            </form>  <br>

            <?php
            while ($row = $result->fetch_object()) {
                $result2 = query("SELECT `Name` FROM php_quiz_details WHERE QuizId='$row->QuizId'");
                ?>

                <?php echo ++$sl; ?>
                <ul><?php echo stripcslashes($row->Name); ?>

                    <?php while ($row2 = $result2->fetch_object()) { ?>
                        <li><?php echo stripcslashes($row2->Name); ?></li>

                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>

        </div>
    </div>
</div>




