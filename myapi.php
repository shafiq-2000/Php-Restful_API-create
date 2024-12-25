<?php
include 'db.php';
header("Content-Type: application/json");
$request = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($request) {
    case 'GET':
        get_data();
        break;

    case 'POST':
        post_data($input);
        break;

    case 'PUT':
        put_data($input);
        break;

    case 'DELETE':
        delete_data($input);
        break;

    default:
        echo "Data not found";
        break;
}

//method 
function get_data()
{
    global $pdo;
    $sql = "SELECT * FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
function post_data($input)
{
    include 'db.php';
    $sql = "INSERT INTO users (name, email, city) VALUES (:name, :email, :city)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'city' => $input['city']]);
    echo json_encode(['message' => 'User created successfully']);
}

function put_data($input)
{
    include 'db.php';
    $sql = "UPDATE users SET name = :name, email = :email, city = :city WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'city' => $input['city'], 'id' => $input['id']]);
    echo json_encode(['message' => 'User updated successfully']);
}

function delete_data($input)
{
    include 'db.php';
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'User deleted successfully']);
}
