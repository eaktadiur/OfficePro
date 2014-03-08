<?php

function getChallanForPrepareBill($companyId) {
    $sql = "SELECT p.`Name`, p.`Code`, u.`Name` AS UName, rd.Remark,
    cd.ChallanDetailsId, cd.Qty, cd.UnitPrice, cd.Total
    FROM challan_details cd
    INNER JOIN challan c ON c.ChallanId=cd.ChallanId
    LEFT JOIN requisition_details rd ON rd.RequisitionDetailsId=cd.RequisitionDetailsId
    LEFT JOIN company_product cp ON cp.ProductId=rd.ProductId AND cp.CompanyId=c.CompanyId
    LEFT JOIN product p ON p.ProductId=cp.ProductId
    LEFT JOIN unit u ON u.UnitId=cp.UnitId
    WHERE c.StatusId=1 AND c.CompanyId='$companyId'";
    $result = query($sql);
    return $result;
}

function getBillInfoId($billIs) {
    $sql = "SELECT b.RefNo, b.Remark, DATE_FORMAT(b.BillDate,'%d %b %Y')AS BillDate, c.`Name` 
    FROM bill b
    LEFT JOIN company c ON c.CompanyId=b.CompanyId
    WHERE b.BillId='$billIs'";
    $result = find($sql);
    return $result;
}

function getBillByBillId($billIs) {
    $sql = "SELECT p.`Name`, p.`Code`, u.`Name` AS UName, cd.Remark,
    bd.BillDetailsId, cd.Qty, cd.UnitPrice, cd.Total
    FROM bill_details bd
    INNER JOIN bill b ON b.BillId=bd.BillId
    LEFT JOIN challan_details cd ON cd.ChallanDetailsId=bd.ChallanDetailsId
    LEFT JOIN company_product cp ON cp.ProductId=bd.ProductId AND cp.CompanyId=b.CompanyId
    LEFT JOIN product p ON p.ProductId=cp.ProductId
    LEFT JOIN unit u ON u.UnitId=cp.UnitId
    WHERE bd.BillId='$billIs'";
    $result = query($sql);
    return $result;
}

function maxBillId() {
    $sql = "SELECT IFNULL(MAX(BillId),0)+1 FROM bill";
    $result = findValue($sql);
    return $result;
}

function maxChallanId() {
    $sql = "SELECT IFNULL(MAX(ChallanId),0)+1 FROM challan";
    $result = findValue($sql);
    return $result;
}

//Approval Start Here
function nextApproval($nextApprovalId, $searchId, $status) {
    $sql = "UPDATE requisition SET PresentLocationId='$nextApprovalId', StatusId='$status' WHERE RequisitionId='$searchId';";
    query($sql);
}

function sendToCustomerVarification($searchId, $status) {
    $sql = "UPDATE requisition SET PresentLocationId=CreatedBy, StatusId='$status' WHERE RequisitionId='$searchId';";
    query($sql);
}

function adminApproval($searchId) {

    $sql = "UPDATE requisition SET StatusId=8 WHERE RequisitionId='$searchId';";
    query($sql);
}

function branchAdminReview($companyId, $searchId, $status) {
    $empId = getAdminServiceByRole($companyId, 5); // 5= Customer Servicer Officer
    $sql = "UPDATE requisition SET PresentLocationId='$empId->EmployeeId', StatusId='$status' WHERE RequisitionId='$searchId';";
    query($sql);
}

function getAdminServiceByRole($companyId, $designationId) {
    $sql = "SELECT EmployeeId 
    FROM employee e 
    WHERE e.CompanyId='$companyId' AND e.DesignationId='$designationId'";
    $result = find($sql);

    return $result;
}

//Approval End Here




function getAllProducts($productList) {
    $res = $productList == '' ? '' : " AND ProductId NOT IN ($productList)";
    $sql = "SELECT ProductId, Name, Code FROM product WHERE 1 $res";
    $stmt = query($sql);
    return $stmt;
}

function getCompanyProduct($companyID) {
    $sql = "SELECT p.Name, p.Code, Price, cp.ProductId 
    FROM company_product cp
    LEFT JOIN product p ON p.ProductId= cp.ProductId
    WHERE cp.CompanyId='$companyID'";

    $stmt = query($sql);

    return $stmt;
}

function getChallanList() {

    $sql = "SELECT c.ChallanId, c.ChallanNo, DATE_FORMAT(c.ChallanDate,'%d %b %Y')AS ChallanDate, 
            CONCAT(em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.FirstName,' ',e.LastName) AS 'RequisitionFrom',
            co.`Name` AS CName, RefNo

            FROM challan c
            LEFT JOIN employee e ON e.EmployeeId=c.CreatedBy
            LEFT JOIN employee em ON em.EmployeeId=PresentLocationId
            LEFT JOIN company co ON co.CompanyId=c.CompanyId
            ORDER BY c.ChallanId DESC";

    $result = query($sql);

    return $result;
}

function getBillList() {

    $sql = "SELECT b.BillId, b.BillNo, DATE_FORMAT(b.BillDate,'%d %b %Y')AS BillDate, 
            co.`Name` AS CName, co.`Code`, RefNo

            FROM bill b
            LEFT JOIN employee e ON e.EmployeeId=b.CreatedBy
            LEFT JOIN company co ON co.CompanyId=b.CompanyId
            ORDER BY b.BillId DESC";

    $result = query($sql);

    return $result;
}

function getApprovalHistoryById($module, $search_id) {
    $sql = "SELECT CONCAT(e.FirstName, ' ', e.LastName, '(',CardNo,')') AS app_person,
    ah.CreatedDate, ah.`Comment`

    FROM approval_history ah
    LEFT JOIN requisition r ON r.RequisitionId=ah.ModuleId
    LEFT JOIN employee e ON e.EmployeeId = ah.EmployeeId
    WHERE ah.ModuleId='$search_id' AND ah.Module='$module'";

    $result = query($sql);

    return $result;
}

function exportCompany($companyId) {
    $result = query("SELECT co.CompanyID, co.`Name`, co.Address1, co.Address2, co.ZipCode, co.Phone, co.Fax, co.Email, co.CurrencySymbol,
                    (CASE WHEN co.IsActive='1' THEN 'Yes' ELSE 'No' END)AS 'Active'
                    FROM company AS co 
                    ORDER BY co.`Name`");


    $rows[] = array('Name' => 'Company Name', 'Address1' => 'Address1', 'Address2' => 'Address12', 'ZipCode' => 'Zip Code', 'Email' => 'Email');

    while ($row = $result->fetch_object()) {
        $rows[] = array('Name' => $row->Name, 'Address1' => $row->Address1, 'Address2' => $row->Address2, 'ZipCode' => $row->ZipCode, 'Email' => $row->Email);
    }

    return ($rows);
}

function getCompanyList() {

    $sql = "SELECT co.CompanyID, co.Code, co.`Name`, co.Address1, co.Address2, co.ZipCode, co.Phone, co.Fax, co.Email, co.CurrencySymbol,
            (CASE WHEN co.IsActive='1' THEN 'Yes' ELSE 'No' END)AS 'Active'
            FROM company AS co 
            ORDER BY co.`Name`";
    $result = query($sql);

    return $result;
}

function getCompanyInfoById($searchId) {

    $sql = "SELECT co.CompanyID, co.Code, co.`Name`, co.Address1, co.Address2, co.ZipCode, 
    co.Phone, co.Fax, co.Email, co.CurrencySymbol, TotalBudget,
    (CASE WHEN co.IsActive='1' THEN 'Yes' ELSE 'No' END)AS 'Active'
    FROM company AS co 
    WHERE co.CompanyId='$searchId'
    ORDER BY co.`Name`";
    $result = find($sql);

    return $result;
}

function getUserList() {

    $sql = "SELECT UserTableId, c.`Name`, ut.UserName, (CASE WHEN ut.IsActive=1 THEN 'Yes' ELSE 'No' END) AS IsActive, c.Email, Phone
    FROM user_table ut
    INNER JOIN employee e ON e.EmployeeId=ut.EmployeeId
    LEFT JOIN company c ON c.CompanyId=e.CompanyId
    LEFT JOIN user_level ul ON ul.UserLevelId=ut.UserLevelId
    WHERE e.RoleId=1";

    $result = query($sql);

    return $result;
}

function getUserById($searchId) {

    $sql = "SELECT UserTableId, ut.UserName, CompanyId,
    (CASE WHEN ut.IsActive=1 THEN 'Yes' ELSE 'No' END) AS IsActive
    FROM user_table ut
    WHERE ut.UserTableId='$searchId'";

    $result = query($sql);

    return $result;
}

function getFixedProductList($companyId) {

    $sql = "SELECT cp.ProductId, p.`Name`, p.`Code`, u.`Name` AS UName
    FROM company_product cp
    INNER JOIN product p ON p.ProductId=cp.ProductId
    INNER JOIN unit u ON u.UnitId=p.UnitId
    WHERE cp.CompanyId='$companyId'
    ORDER BY p.`Name`";

    $result = query($sql);

    return $result;
}

function getProductList() {

    $sql = "SELECT p.ProductId, p.`Name`, p.`Code`, u.`Name` AS UName
    FROM product p  
    INNER JOIN unit u ON u.UnitId=p.UnitId
    ORDER BY p.`Name`";

    $result = query($sql);

    return $result;
}

function getRequisitionList($employeeId, $companyId) {
    $sql = "SELECT r.RequisitionId, r.RequisitionNo, r.RequisitionDate, 
            CONCAT(em.CardNo, '->', em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.CardNo, '->',e.FirstName,' ',e.LastName) AS 'RequisitionFrom',
            s.`Name` SName, c.`Name` AS CName

            FROM requisition r
            INNER JOIN `status` s ON s.StatusId=r.StatusId
            LEFT JOIN employee e ON e.EmployeeId=r.CreatedBy
            LEFT JOIN employee em ON em.EmployeeId=PresentLocationId
            INNER JOIN company c ON c.CompanyId=r.CompanyId
            WHERE r.CompanyId='$companyId' AND r.CreatedBy='$employeeId'
            ORDER BY r.RequisitionId DESC";

    $result = query($sql);

    return $result;
}

function getPendingRequisitionList($employeeId, $companyId) {
    $sql = "SELECT r.RequisitionId, r.RequisitionNo, r.RequisitionDate, 
            CONCAT(em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.FirstName,' ',e.LastName) AS 'RequisitionFrom',
            s.`Name` SName, c.`Name` AS CName

            FROM requisition r
            INNER JOIN `status` s ON s.StatusId=r.StatusId
            INNER JOIN employee e ON e.EmployeeId=r.CreatedBy
            INNER JOIN employee em ON em.EmployeeId=PresentLocationId
            INNER JOIN company c ON c.CompanyId=r.CompanyId
            WHERE r.CompanyId='$companyId' AND r.PresentLocationId='$employeeId' AND r.StatusId>1
            ORDER BY r.RequisitionId DESC";

    $result = query($sql);

    return $result;
}

function getApprovedRequisitionList($employeeId) {
    $sql = "SELECT r.RequisitionId, r.RequisitionNo, r.RequisitionDate, 
            CONCAT(em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.FirstName,' ',e.LastName, ' (', c.`Name`, ')') AS 'RequisitionFrom',
            s.`Name` SName, c.`Name` AS CName

            FROM requisition r
            INNER JOIN `status` s ON s.StatusId=r.StatusId
            INNER JOIN employee e ON e.EmployeeId=r.CreatedBy
            INNER JOIN employee em ON em.EmployeeId=PresentLocationId
            INNER JOIN company c ON c.CompanyId=r.CompanyId
            WHERE r.PresentLocationId='$employeeId' AND r.StatusId<>8
            ORDER BY r.RequisitionId DESC";

    $result = query($sql);

    return $result;
}

function getApprovedRequisitionForChallanList($employeeId) {
    $sql = "SELECT r.RequisitionId, r.RequisitionNo, r.RequisitionDate, 
            CONCAT(em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.FirstName,' ',e.LastName, ' (', c.`Name`, ')') AS 'RequisitionFrom',
            s.`Name` SName, c.`Name` AS CName

            FROM requisition r
            INNER JOIN `status` s ON s.StatusId=r.StatusId
            INNER JOIN employee e ON e.EmployeeId=r.CreatedBy
            INNER JOIN employee em ON em.EmployeeId=PresentLocationId
            INNER JOIN company c ON c.CompanyId=r.CompanyId
            WHERE r.PresentLocationId='$employeeId' AND r.StatusId=8
            ORDER BY r.RequisitionId DESC";

    $result = query($sql);

    return $result;
}

function getProductByCompanyId($companyId, $productList) {
    $res = $productList == '' ? '' : " AND cp.ProductId NOT IN ($productList)";

    echo $sql = "SELECT p.ProductId, p.`Name`, Price, u.`Name` AS 'UnitName', p.`Code`
            FROM company_product cp
            INNER JOIN product p ON p.ProductId=cp.ProductId
            LEFT JOIN unit u ON u.UnitId=cp.UnitId
            WHERE cp.CompanyId='$companyId' $res";

    $stmt = query($sql);

    return $stmt;
}

function getCompanyProductList($companyId) {

    echo $sql = "SELECT p.ProductId, p.`Name`, Price, u.`Name` AS 'UnitName', p.`Code`
            FROM company_product cp
            INNER JOIN product p ON p.ProductId=cp.ProductId
            LEFT JOIN unit u ON u.UnitId=cp.UnitId
            WHERE cp.CompanyId='$companyId'";

    $stmt = query($sql);

    return $stmt;
}

function getEmployeeById($employeeId) {
    $sql = "SELECT FirstName, LastName, DesignationId, Cell, Email 
            FROM employee e
            WHERE EmployeeId='$employeeId'";

    $stmt = find($sql);

    return $stmt;
}

function getRequisitionById($requisitionId) {
    $sql = "SELECT r.RequisitionId, r.RequisitionNo, r.RequisitionDate, 
            CONCAT(em.FirstName,' ',em.LastName) AS PresentLocation,
            CONCAT(e.FirstName,' ',e.LastName) AS 'RequisitionFrom',
            s.`Name` SName, c.`Name` AS CName, r.Remark, r.CompanyId,
            r.StatusId, r.CreatedBy, r.PresentLocationId

            FROM requisition r
            INNER JOIN `status` s ON s.StatusId=r.StatusId
            INNER JOIN employee e ON e.EmployeeId=r.CreatedBy
            INNER JOIN employee em ON em.EmployeeId=PresentLocationId
            INNER JOIN company c ON c.CompanyId=r.CompanyId
            WHERE r.RequisitionId='$requisitionId'";

    $result = find($sql);

    return $result;
}

function getChallanById($challanId) {
    $sql = "SELECT ch.ChallanId, ch.ChallanNo, ch.ChallanDate, 
            CONCAT(e.FirstName,' ',e.LastName) AS 'RequisitionFrom',
            c.`Name` AS CName, ch.CompanyId

            FROM challan ch
            INNER JOIN employee e ON e.EmployeeId=ch.CreatedBy
            INNER JOIN company c ON c.CompanyId=ch.CompanyId
            WHERE ch.ChallanId='$challanId'";

    $result = find($sql);

    return $result;
}

function getRequisitionDetailsById($requisitionId) {
    $sql = "SELECT p.`Name`, rd.Qty, rd.Remark, p.`Code`
            FROM requisition_details rd
            INNER JOIN product p ON p.ProductId=rd.ProductId
            WHERE rd.RequisitionId='$requisitionId'";

    $result = query($sql);

    return $result;
}

function getEmployeeByCompanyId($companyId) {
    $sqlEmployee = "SELECT emp.employeeId, emp.CardNo, emp.FirstName, cmp.Name, 
    emp.DesignationId, CONCAT(e.FirstName,' ',e.LastName) AS nextPers, emp.email, d.`Name` AS DName,
    emp.LastName, r.`Name` AS RName

    FROM employee emp
    INNER JOIN company cmp ON cmp.CompanyId = emp.CompanyId
    LEFT JOIN employee e ON e.EmployeeId = emp.NextApprovalId
    LEFT JOIN role r ON r.RoleId=emp.RoleId
    LEFT JOIN designation d ON d.DesignationId=emp.DesignationId
    WHERE emp.CompanyId='$companyId' ORDER BY emp.FirstName";

    $stmtEmp = query($sqlEmployee);

    return $stmtEmp;
}

function getEmployeeDetails($empID) {
    //$res = $productList == '' ? '' : " AND cp.ProductId NOT IN ($productList)";
    $sqlEmployeeDetails = "SELECT emp.employeeId, emp.CardNo, emp.FirstName,emp.LastName, 
    emp.MiddleName, emp.SurName, cmp.Name, emp.DesignationId, emp.RoleId, d.`Name` AS DName,
    empl.FirstName AS nextPers,emp.email, emp.Cell, emp.PresentAddress, emp.NextApprovalId
    FROM employee emp
    LEFT JOIN designation d ON d.DesignationId=emp.DesignationId
    LEFT OUTER JOIN company cmp ON cmp.CompanyId = emp.companyId
    LEFT OUTER JOIN employee empl ON empl.EmployeeId = emp.EmployeeId 
    WHERE emp.employeeId='$empID'";
    $stmtEmp = find($sqlEmployeeDetails);

    return $stmtEmp;
}

//function getEmployeeDetailsEdit($empID) {
//    $sqlEmployeeDetails = "SELECT emp.employeeId, emp.CardNo, emp.FirstName, emp.LastName, emp.PresentAddress, emp.MiddleName, emp.Surname, emp.Cell, cmp.CompanyId, emp.DesignationId, empl.employeeId AS nextPers,emp.email FROM employee emp
//    LEFT OUTER JOIN company cmp ON cmp.CompanyId = emp.companyId
//    LEFT OUTER JOIN employee empl ON empl.EmployeeId = emp.EmployeeId WHERE emp.employeeId=$empID";
//    $stmtEmp = find($sqlEmployeeDetails);
//
//    return $stmtEmp;
//}
//        Combo function Start from Here
function getCompanyComb() {

    $sql = "SELECT CompanyId, `Name`, `Code` FROM company ORDER BY `Name`";

    $result = rs2array($sql);

    return $result;
}

function getEmployeeByCompanyIdComb($companyId) {

    $sql = "SELECT EmployeeId, CardNo, CONCAT(FirstName,' ',LastName, ' (', d.`Name`, ')') AS EmpName 
    FROM employee e
    LEFT JOIN designation d ON d.DesignationId=e.DesignationId
    WHERE e.CompanyId='$companyId' 
    ORDER BY FirstName";

    $result = rs2array($sql);

    return $result;
}

function getDesignationByCompanyIdComb($companyId) {

    $sql = "SELECT DesignationId, `Name` FROM designation WHERE CompanyId='$companyId' ORDER BY `Name`";

    $result = rs2array($sql);

    return $result;
}

function getRoleCompanyIdComb() {

    $result = array(array('1', 'admin'), array('2', 'Staff'), array('3', 'Customer Service'), array('4', 'Accounts'), array('5', 'Reviewer'));

    return $result;
}

function getEmployeeByDesignation($companyId, $designationId) {
    $sql = "SELECT EmployeeId, CONCAT(FirstName,' ',LastName) AS empName 
            FROM employee WHERE CompanyId='$companyId' AND DesignationId='$designationId'";

    $result = rs2array($sql);

    return $result;
}

function agreeMentList() {
    $result = array(
        array('1', 'Product Fixed'),
        array('2', 'Budget Fixed'),
        array('3', 'Price Fixed')
    );
    return $result;
}

function getUnits() {

    $sqlDesignation = "SELECT UnitId, Name FROM unit";
    $stmtEmp = query($sqlDesignation);
    return $stmtEmp;
}

function getAUnit($id) {
    $sqlDesignation = "SELECT Name FROM unit WHERE UnitId='$id'";
    $stmt = findvalue($sqlDesignation);
    return $stmt;
}
