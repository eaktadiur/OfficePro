<?php
include '../lib/DbManager.php';
include '../body/header.php';
?>

<script>
    $(document).ready(function(){
 
        $("tr:has(td.parent)").each(function() {
            var sum = 0;
            $(this).nextUntil(':not(:has(td.child))').children(':nth-child(2)').each(function() {
                sum += parseInt(this.innerHTML, 10);
            });
            $(this).children(':eq(1)').text(sum);
        });

    });
</script>

<h1>1 Table</h1>
<table>
    <tbody>
        <tr><th>Player</th><th>Score</th></tr>
        <tr><td>Jack</td><td>7</td></tr>
        <tr><td class="parent">Green Team</td><td>16</td></tr>
        <tr><td class="child">Mark</td><td>11</td></tr>
        <tr><td class="child">Tom</td><td>5</td></tr>
        <tr><td>Steven</td><td>8</td></tr>
        <tr><td>Greg</td><td>4</td></tr>
        <tr><td class="parent">Blue Team</td><td>31</td></tr>
        <tr><td class="child">Joe</td><td>10</td></tr>
        <tr><td class="child">Jill</td><td>12</td></tr>
        <tr><td class="child">Rachel</td><td>9</td></tr>
    </tbody>
</table>



<script type="text/javascript">
    $(document).ready(function(){
        
        $("#count_table_rows tbody tr").change(rowAverage);
        
        function rowAverage() {
            var totalAvg = 0;
            $("tbody tr").slice(0,-1).each(function() {
                var row_total = 0;
                var i = $("td:not(.subtotal) input:text", this).each(function() {
                    row_total += parseInt(this.value || 0, 10);
                }).length;

                if (row_total > 0) {
                    var avg = Math.floor(parseInt(row_total, 10) / i);
                    $(".subtotal input:text", this).val(avg);
                    totalAvg += avg;
                }
            });
            
            alert(row_total);
            $(".total input").val(totalAvg);
        }







 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {
            $(this).keyup(function(){
                calculateSum();
            });
        });
        
        function RowSum() {
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".qty").each(function() {
 
                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum += parseFloat(this.value);
                }
 
            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#sum").html(sum.toFixed(2));
        }
 
        function calculateSum() {
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".txt").each(function() {
 
                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum += parseFloat(this.value);
                }
 
            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#sum").html(sum.toFixed(2));
        }
        
        $('.txt').keyup(function() {
            $('#count_table_rows tr td').each(function(){
                var t=$('input').val();
                //alert(t);
            });

            //var rows = $("#count_table_rows tr").length;

            //alert($(this).closest("tr").index());
            //alert($(this).closest("tr").index());
            // var colIndex = $(this).parent().children().index($(this));
            //var rowIndex = $(this).parent().parent().children().index($(this).parent());
            //alert('Row: ' + rowIndex + ', Column: ' + colIndex);
            
            //$("#count_table_rows").children().children()[1].children[2].innerHTML = colIndex;
            //alert(total);  
                
        });
        
        var otable=$('#count_table_rows').$(this);
        alert(otable[1][1]);
        
        
        
    });
    
</script>
<h1>1st Table</h1>
<table class="display_table" id="count_table_rows">
    <thead>
    <th>SL</th>
    <th>Item Name</th>
    <th>Text</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</thead>
<tbody>
    <tr>
        <td width="40px">1</td>
        <td>Butter</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr>
        <td>2</td>
        <td>Cheese</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr>
        <td>3</td>
        <td>Eggs</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr>
        <td>4</td>
        <td>Milk</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr>
        <td>5</td>
        <td>Bread</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr>
        <td>6</td>
        <td>Soap</td>
        <td><input class="txt" type="text" name="txt"/></td>
        <td><input class="qty" type="text" name="txt"/></td>
        <td><input class="price" type="text" name="txt"/></td>
        <td><input class="total" type="text" name="txt"/></td>
    </tr>
    <tr id="summation">
        <td>&nbsp;</td>
        <td>Sum :</td>
        <td><span id="sum">0</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</tbody>
</table>





<h1>2nd Table</h1>
<table class="display_table"id="second" >
    <th>balance</th>
    <td><input type="text" name="qty" class="qty" /></td>
    <td><input type="text" name="qty" class="qty" /></td>

    <tr>
        <th>gains</th>
        <td>20</td>
    </tr>
    <tr>
        <th>loses</th>
        <td>-36</td>
    </tr>
    <tr class="sum">
        <th>Total</th>
        <td class="sum">#</td>
    </tr>
</table>




<script>
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {
 
            $(this).keyup(function(){
                calculateSum();
            });
        });
        
        $(function(){
            function tally (selector) {
                $(selector).each(function () {
                    var total = 0,
                    column = $(this).siblings(selector).andSelf().index(this);
                    $(this).parents().prevUntil(':has(' + selector + ')').each(function () {
                        total += parseFloat($('td.sum:eq(' + column + ')', this).html()) || 0;
                    })
                    $(this).html(total);
                });
            }
            tally('td.subtotal');
            tally('td.total');
        });
        
        tall('#second');
 
    });
 
    function calculateSum() {
 
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum").html(sum.toFixed(2));
    }
    
    
    
    function sumOfColumns(table, columnIndex) {
        var tot = 0;
        table.find("tr").children("td:nth-child(" + columnIndex + ")")
        .each(function() {
            $this = $(this);
            if (!$this.hasClass("sum") && $this.html() != "") {
                tot += parseInt($this.html());
            }
        });
        return tot;
    }

    function do_sums() {
        $("tr.sum").each(function(i, tr) {
            $tr = $(tr);
            $tr.children().each(function(i, td) {
                $td = $(td);
                var table = $td.parent().parent().parent();
                if ($td.hasClass("sum")) {
                    $td.html(sumOfColumns(table, i+1));
                }
            })
        });
    }
</script>
<?php include '../body/footer.php'; ?>