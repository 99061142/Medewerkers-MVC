<?php
require(ROOT . "model/EmployeeModel.php");


// Pages


// Homepage (load automatically)
function index(){
    $employees = getAllEmployees();
    render('employee/index', $employees);
}


// Create page
function create(){
    render('employee/create');
}


// Edit page
function edit($id){
    $employee = getEmployee($id);
    render("employee/update", $employee);
}


// Delete page
function delete($id){
    $employee = getEmployee($id);
    render("employee/delete", $employee);
}




// Codes


// Create a new employee
function store(){
    createEmployee($_POST);
    header("location:" . URL);
}


// Update a employee
function update(){
    $beforeEditInformation = getEmployee($_POST["id"]);
    updateEmployee($_POST, $beforeEditInformation);
    header("location:" . URL);
}


// Delete a employee
function destroy($id){
    deleteEmployee($id);
    header("location:" . URL);
}