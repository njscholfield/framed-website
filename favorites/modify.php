<?php
  session_start();
  
  $data = json_decode(file_get_contents('php://input'), true);

  if(!isset($data) || empty($data) || !isset($_SESSION) || !isset($_SESSION['userID'])) {
    response(false, "Invalid request");
    die();
  }
  require('../partials/env.php');
  require('../partials/database.php');
  
  function response($success, $reason) {
    $response['success'] = ($success) ? true : false;
    if(!$success) {
      $response['reason'] = $reason;
    }
    echo json_encode($response);
  }
  
  function addFavorite($id) {
    global $connection;
    $query = "INSERT INTO FramedFavorites VALUES ({$_SESSION['userID']}, {$id})";
    $result = mysqli_query($connection, $query);
    response($result, "Cannot add favorite");
  }
  
  function deleteFavorite($id) {
    global $connection;
    $query = "DELETE FROM FramedFavorites WHERE userID = {$_SESSION['userID']} AND productID = {$id}";
    $result = mysqli_query($connection, $query);
    response($result, "Cannot delete favorite");
  }
  
  function getFavorites() {
    response(false);
  }
  
  switch($data['action']) {
    case 'Add': 
      addFavorite($data['itemID']);
      break;
    case 'Delete':
      deleteFavorite($data['itemID']);
      break;
    default:
      echo "Test";
      break;
  }
?>