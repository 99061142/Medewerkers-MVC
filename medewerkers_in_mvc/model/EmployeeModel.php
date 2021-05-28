<?php

    function getAllEmployees(){
      // Met het try statement kunnen we code proberen uit te voeren. Wanneer deze
      // mislukt kunnen we de foutmelding afvangen en eventueel de gebruiker een
      // nette foutmelding laten zien. In het catch statement wordt de fout afgevangen
       try {
           // Open de verbinding met de database
           $conn=openDatabaseConnection();
       
           // Zet de query klaar door middel van de prepare method
           $stmt = $conn->prepare("SELECT * FROM employees");

           // Voer de query uit
           $stmt->execute();

           // Haal alle resultaten op en maak deze op in een array
           // In dit geval is het mogelijk dat we meedere medewerkers ophalen, daarom gebruiken we
           // hier de fetchAll functie.
           $result = $stmt->fetchAll();

       }
       // Vang de foutmelding af
       catch(PDOException $e){
           // Zet de foutmelding op het scherm
           echo "Connection failed: " . $e->getMessage();
       }

       // Maak de database verbinding leeg. Dit zorgt ervoor dat het geheugen
       // van de server opgeschoond blijft
       $conn = null;

       // Geef het resultaat terug aan de controller
       return $result;
    }

    function getEmployee($id){
        try {
            // Open de verbinding met de database
            $conn=openDatabaseConnection();
     
            // Zet de query klaar door midel van de prepare method. Voeg hierbij een
            // WHERE clause toe (WHERE id = :id. Deze vullen we later in de code
            $stmt = $conn->prepare("SELECT * FROM employees WHERE id = :id");
            // Met bindParam kunnen we een parameter binden. Dit vult de waarde op de plaats in
            // We vervangen :id in de query voor het id wat de functie binnen is gekomen.
            $stmt->bindParam(":id", $id);

            // Voer de query uit
            $stmt->execute();

            // Haal alle resultaten op en maak deze op in een array
            // In dit geval weten we zeker dat we maar 1 medewerker op halen (de where clause), 
            //daarom gebruiken we hier de fetch functie.
            $result = $stmt->fetch();
     
        }
        catch(PDOException $e){

            echo "Connection failed: " . $e->getMessage();
        }
        // Maak de database verbinding leeg. Dit zorgt ervoor dat het geheugen
        // van de server opgeschoond blijft
        $conn = null;
     
        // Geef het resultaat terug aan de controller
        return $result;
     }

    function createEmployee($data){
        // Maak hier de code om een medewerker toe te voegen

     }


     function updateEmployee($data){
        // Maak hier de code om een medewerker te bewerken


        // Employee information
        $id = $data["id"];
        $employee = getEmployee($id);


        // Get the previous information
        if(!$_POST["name"]){
            $data["name"] = $employee["name"];
        }

        if(!$_POST["age"]){
            $data["age"] = $employee["age"];
        }


        // Cant make the employees name longer than 10 characters
        if(strlen($data["name"]) > 10){
            $data["name"] = "[name]";
        }


        // The employees age cant be over 3 characters
        if(strlen($data["age"]) > 3){
            $data["age"] = "[age]";
        }


        // Add the data to the employee that the user wanted to chance
        try{
            $conn=openDatabaseConnection();

            $stmt = $conn->prepare("UPDATE employees SET name = :name, age = :age WHERE id = :id");


            // Update the values that are send with it
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":age", $data["age"]);


            $stmt->execute();
            header("location:" . URL);
        }catch(PDOException $e){ 
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }


    function deleteEmployee($id){
        // Maak hier de code om een medewerker te verwijderen
    }
?>