<?php
  session_start();
  header('Content-Type: application/json');
  $data = json_decode(file_get_contents('php://input'), true);

  if(!isset($_SESSION) || !isset($_SESSION['userID'])) {
    response(false, "Not logged in");
    die();
  }
  if(!isset($_ENV['SERVER_ROOT'])) {
    require('../partials/env.php');
  }
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
    global $connection;
    $query = "SELECT productID FROM FramedFavorites WHERE userID = {$_SESSION['userID']}";
    $result = mysqli_query($connection, $query);
    if($result) {
      $favorites['success'] = true;
      while($row = mysqli_fetch_row($result)) {
        $favorites['favorites'][] = $row[0];
      }
      if(!isset($favorites['favorites'][0])) {
        $favorites['favorites'] = array();
      }
      $json = json_encode($favorites);
      echo $json;
      mysqli_free_result($result);
    } else {
      response(false, "Error fetching favorites");
    }
  }

  switch($data['action']) {
    case 'Add':
      addFavorite($data['itemID']);
      break;
    case 'Delete':
      deleteFavorite($data['itemID']);
      break;
    default:
      getFavorites();
      break;
  }

  mysqli_close($connection);
?>
