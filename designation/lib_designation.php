<?php
function getDesignations(){   
            $whereClause=" WHERE 1";
            if ($id!=''){$whereClause.=" AND DesignationId='$id'";}
            $sqlDesignation = "SELECT DesignationId, Name FROM designation $whereClause";
            $stmtEmp = query($sqlDesignation);
            return $stmtEmp;
}


function getADesignation($id){   
            $whereClause=" WHERE 1";
            if ($id!=''){$whereClause.=" AND DesignationId='$id'";}
            $sqlDesignation = "SELECT Name FROM designation $whereClause";
            $stmt = findvalue($sqlDesignation);
            return $stmt;
} 






?>