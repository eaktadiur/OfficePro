<?php
include './db-settings.php';
include("../body/header.php");
$DB_NAME = 'enroute';

$search_id = getParam('search_id');
$mode = getParam('mode');
$object_id = getParam('object_id');
$sql = "SELECT * FROM `$object_id`";
?>
<div class="row-fluid sortable">		
    <div class="box span12 hidden-print">
        <div class="box-header well" data-original-title>
            <h3>
                <a href="#">Home</a> <span class="divider">/</span>
                <a href="#">Form Generate</a>
            </h3>
        </div>
        <div class="box-content">
            <form role="form">
                <div class="span6">

                    <?php
                    $sl = 1;
                    $result_sql = query($sql);
                    $totalField = mysqli_num_fields($result_sql);
                    $totalField = $totalField - 4;

                    while ($meta = $result_sql->fetch_field()) {
                        $fielf_sql = "SELECT DATA_TYPE, COLUMN_COMMENT, COLUMN_NAME,
                                ORDINAL_POSITION, IS_NULLABLE, COLUMN_TYPE
                                FROM information_schema.COLUMNS 
                                WHERE TABLE_NAME ='$meta->table' AND 
                                COLUMN_NAME='$meta->name' AND TABLE_SCHEMA='$meta->db'";
                        $comments = find($fielf_sql);
                        //ORDINAL_POSITION Odd
                        if ($comments->ORDINAL_POSITION % 2 == 1 && $comments->ORDINAL_POSITION <= $totalField) {
                            ?>

                            <div class="form-group">
                                <label for="<?php echo $meta->name; ?>" class="col-sm-2 control-label"><?php echo $meta->name; ?></label>
                                <div class="col-sm-10">
                                    <?php
                                    if ($comments->DATA_TYPE == 'varchar') {
                                        echo "<input type='text' name='$meta->name' class='form-control input-sm' id='$meta->name' required/>";
                                    } elseif ($comments->DATA_TYPE == 'int') {
                                        comboBox($comments->COLUMN_NAME, $data, $var->COLUMN_NAME, TRUE, 'form-control input-sm');
                                    }
                                    ?>
                                </div>
                            </div>


                            <?php
                            $sl++;
                        }
                    }
                    ?>
                </div>
                <div class="span6">

                    <?php
                    $sl = 1;
                    $result_sql = query($sql);
                    $totalField = mysqli_num_fields($result_sql);
                    $totalField = $totalField - 4;

                    while ($meta = $result_sql->fetch_field()) {
                        $fielf_sql = "SELECT DATA_TYPE, COLUMN_COMMENT, COLUMN_NAME,
                                ORDINAL_POSITION, IS_NULLABLE, COLUMN_TYPE
                                FROM information_schema.COLUMNS 
                                WHERE TABLE_NAME ='$meta->table' AND 
                                COLUMN_NAME='$meta->name' AND TABLE_SCHEMA='$meta->db'";
                        $comments = find($fielf_sql);
                        //ORDINAL_POSITION even
                        if ($comments->ORDINAL_POSITION % 2 == 0 && $comments->ORDINAL_POSITION <= $totalField) {
                            ?>

                            <div class="form-group">
                                <label for="<?php echo $meta->name; ?>" class="col-sm-2 control-label"><?php echo $meta->name; ?></label>
                                <div class="col-sm-10">
                                    <?php
                                    if ($comments->DATA_TYPE == 'varchar') {
                                        echo "<input type='text' name='$meta->name' class='withFull' id='$meta->name' required/>";
                                    } elseif ($comments->DATA_TYPE == 'int') {
                                        comboBox($comments->COLUMN_NAME, $data, $var->COLUMN_NAME, TRUE, 'withFull');
                                    }
                                    ?>
                                </div>
                            </div>


                            <?php
                            $sl++;
                        }
                    }
                    ?>
                </div>
                <div class="form-fields">
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-primary" onclick="goBack();">
                        <i class="icon icon-white icon-arrow-down"></i> 
                        Go Back
                    </button>
                </div>
            </form>
        </div>
    </div><!--/span-->       
</div>

<?php
include("../body/footer.php");
?>
