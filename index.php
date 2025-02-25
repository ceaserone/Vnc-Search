<?php
$country = isset($_GET['country']) ? $_GET['country'] : "US"; // Default to 'US' if not provided
$api_url = "https://computernewb.com/vncresolver/api/scans/vnc/search?country=" . urlencode($country);
$response = file_get_contents($api_url);
$data = json_decode($response, true);

$results = $data['result'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="synacknetwork.com">
    <title>VNC Search</title>
    <style>
        body {
            background-color: #474545;
            color: #186cb5;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            background: #333;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #ffffff;
        }
        .search-box {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 60%;
            border: none;
            border-radius: 5px;
            outline: none;
        }
        button {
            padding: 10px;
            background: #7a1a1a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #2e0404;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #444;
        }
        th {
            background: #7a1a1a;
            color: white;
        }
        td {
            color: #bbb;
        }
        tr:hover {
            background: #333;
        }
        .id-link {
            color: #186cb5;
            text-decoration: none;
            font-weight: bold;
        }
        .id-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>VNC Search</h2>
    
    <div class="search-box">
        <form method="GET">
            <input type="text" name="country" placeholder="Enter country code (e.g., US, RO)" value="<?php echo htmlspecialchars($country); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (empty($results)): ?>
        <p>No results found.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Details</th>
            </tr>
            <?php foreach ($results as $id): ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><a class="id-link" href="vnc-details.php?id=<?php echo $id; ?>">View Details</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
