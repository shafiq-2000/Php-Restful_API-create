<?php 
// $url = "https://jsonplaceholder.typicode.com/users";

// // API থেকে ডেটা পাওয়া
// $response = file_get_contents($url);

// // JSON ডেটা PHP অ্যারেতে রূপান্তর
// $data = json_decode($response, true);

// // ডেটা দেখানো
// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>

<?php
$url = "https://jsonplaceholder.typicode.com/users";

$response = file_get_contents($url);

$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Data Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h1>User Data from API</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)) {
            foreach ($data as $user) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
 
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="2">No data available</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
