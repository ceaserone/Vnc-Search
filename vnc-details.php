<?php
if (!isset($_GET['id'])) {
    echo "No ID provided.";
    exit;
}

$id = intval($_GET['id']);
$api_url = "https://computernewb.com/vncresolver/api/scans/vnc/id/$id";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data) {
    echo "No data found.";
    exit;
}

// Convert timestamp to readable format
$created_at = isset($data['createdat']) ? date("Y-m-d H:i:s", $data['createdat'] / 1000) : "N/A";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNC Details</title>
    <style>
        body {
            background-color: #474545;
            color: #186cb5;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 90%; /* Adjusted to take up more screen width */
            max-width: 600px; /* Limit max width */
            margin: 20px auto;
            padding: 20px;
            background: #333;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            text-align: left;
        }
        h2 {
            text-align: center;
            color: #ffffff;
        }
        .info {
            margin: 15px 0;
            padding: 15px;
            background: #222;
            border-radius: 10px;
            display: flex;
            align-items: center;
        }
        .info i {
            margin-right: 15px;
            color: #7a1a1a;
        }
        .info strong {
            color: #fff;
        }
        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #7a1a1a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
        .back:hover {
            background: #2e0404;
        }
        /* Ensure responsiveness for smaller screens */
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
            .info {
                font-size: 14px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

<div class="container">
    <h2>VNC Details</h2>
    
    <div class="info"><i class="fas fa-hashtag"></i> <strong>ID:</strong> <?php echo $data['id']; ?></div>
    <div class="info"><i class="fas fa-globe"></i> <strong>IP Address:</strong> <?php echo $data['ip']; ?> : <?php echo $data['port']; ?></div>
    <div class="info"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> <?php echo $data['city']; ?>, <?php echo $data['state']; ?>, <?php echo $data['country']; ?></div>
    <div class="info"><i class="fas fa-server"></i> <strong>Hostname:</strong> <?php echo $data['hostname'] ?: "N/A"; ?></div>
    <div class="info"><i class="fas fa-building"></i> <strong>ASN:</strong> <?php echo $data['asn'] ?: "N/A"; ?></div>
    <div class="info"><i class="fas fa-user"></i> <strong>Client Name:</strong> <?php echo $data['clientname'] ?: "N/A"; ?></div>
    <div class="info"><i class="fas fa-expand"></i> <strong>Screen Resolution:</strong> <?php echo $data['screenres'] ?: "N/A"; ?></div>
    <div class="info"><i class="fas fa-key"></i> <strong>Password:</strong> <?php echo $data['password'] ?: "N/A"; ?></div>
    <div class="info"><i class="fas fa-clock"></i> <strong>Created At:</strong> <?php echo $created_at; ?></div>

    <a class="back" href="index.php">Back to Search</a>
</div>

</body>
</html>
