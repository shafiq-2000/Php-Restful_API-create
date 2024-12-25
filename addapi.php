<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id']; // যাকে আপডেট করতে চাই
    $url = "https://jsonplaceholder.typicode.com/users/" . $id;

    // আপডেট ডেটা
    $updatedData = [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'email' => $_POST['email']
    ];

    // JSON-এ রূপান্তর
    $jsonData = json_encode($updatedData);

    // HTTP অপশন
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'PUT',
            'content' => $jsonData
        ]
    ];

    // API-তে পাঠানো
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // রেসপন্স দেখানো
    echo "User updated: ";
    echo "<pre>";
    print_r(json_decode($response, true));
    echo "</pre>";
}
?>

<h2>Update User</h2>
<form method="POST">
    <label>User ID:</label>
    <input type="number" name="id" required>
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit" name="update_user">Update User</button>
</form>
