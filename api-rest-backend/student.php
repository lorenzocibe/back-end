<?php
  include('./class/Student.php');
  $method = $_SERVER["REQUEST_METHOD"];
  $student = new Student();

  switch($method) {
    case 'GET': 
      $id = $_GET['id'];
      if (isset($id)) //gets 1 row
      {
        $student = $student->find($id);
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
      }else //gets all rows
      {
        $students = $student->all();
        $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
      }
      header("Content-Type: application/json");
      echo($js_encode);
      break;

    case 'POST': //adds a row 
      $studentLenght = count($student->all()); //last row + 1 
      $result = $student->all();

      $student->_id = $result[$studentLenght-1]['id'] + 1; //$studentLenght - 1 because we need last element (not Logic Lenght) 
      $student->_name = $_POST["name"];
      $student->_surname = $_POST["surname"];
      $student->_sidiCode = $_POST["sidi_code"];
      $student->_taxCode = $_POST["tax_code"];
      $student->add($student);
      echo "Row added to db";
      break;

    case 'DELETE': //delets a row
      $uri = explode('/', $_SERVER["REQUEST_URI"]); //get student id (explode split a string by searching a character)
      if(count($uri) != 0) 
      {
        $student->delete($uri[count($uri)-1]); //get last "substring" after the character '/'
        echo "Row deleted";
      }
      else echo "ID missing";
      break;

    case 'PUT': //updates a row
      $uri = explode('/', $_SERVER["REQUEST_URI"]); //get student id 
      if(count($uri) != 0)
      {
        $body = file_get_contents("php://input"); //get the body of the requested URI
        $decodeBody = json_decode($body, true);

        $student->_id = $uri[count($uri)-1];
        $student->_name = $decodeBody["_name"];
        $student->_surname = $decodeBody["_surname"];
        $student->_sidiCode = $decodeBody["_sidiCode"];
        $student->_taxCode = $decodeBody["_taxCode"];
  
        $student->update($student);
        echo "Row updated";
      }
      else echo "ID missing";
      break;

    default: 
      echo "Error"; 
      break;
  }
?>
