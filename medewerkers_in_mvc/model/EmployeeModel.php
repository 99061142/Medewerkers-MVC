<?php
function getAllEmployees(){
   try {
       $conn=openDatabaseConnection();
       $stmt = $conn->prepare("SELECT * FROM employees");

       $stmt->execute();
       $employees = $stmt->fetchAll();
       return $employees;
   }catch(PDOException $e){
       echo "Connection failed: " . $e->getMessage();
   }
   $conn = null;
}


function cleanData($data){
    foreach($data as $value_name => $value){
        $value = trim($data[$value_name]);
        $value = stripslashes($data[$value_name]);
        $value = htmlspecialchars($data[$value_name]);
        $data[$value_name] = $value;
    }
    return $data;
}


function cleanEditData($data, $previous_Data){
    foreach($data as $value_name => $value){
        if(!$data[$value_name]){
            $data[$value_name] = $previous_Data[$value_name];
        }else{
            $value = trim($data[$value_name]);
            $value = stripslashes($data[$value_name]);
            $value = htmlspecialchars($data[$value_name]);
            $data[$value_name] = $value;
        }
    }
    return $data;
}




function getEmployee($id){
    try {
        $conn=openDatabaseConnection();
        $stmt = $conn->prepare("SELECT * FROM employees WHERE id = :id");
        $stmt->bindParam(":id", $id);


        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
 }




function createEmployee($data){
    $data = cleanData($data);
    try {
        $conn=openDatabaseConnection();
        $stmt = $conn->prepare("INSERT INTO employees (name, age) VALUES (:name, :age)");

        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":age", $data["age"]);
        $stmt->execute();
    }catch(PDOException $e){ 
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null; 
}




function updateEmployee($data, $previous_Data){
    $data = cleanEditData($data, $previous_Data);
    try{
        $conn=openDatabaseConnection();
        $stmt = $conn->prepare("UPDATE employees SET name = :name, age = :age WHERE id = :id");

        $stmt->bindParam(":id", $data["id"]);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":age", $data["age"]);
        $stmt->execute();
    }catch(PDOException $e){ 
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
}




function deleteEmployee($id){
    try{
        $conn=openDatabaseConnection();
        $query = $conn->prepare("DELETE FROM employees WHERE id= :id");

        $query->bindParam(":id", $id);
        $query->execute(); 
    }catch(PDOException $e){ 
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
}