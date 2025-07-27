<?php
include_once(__DIR__ . '/../../../dbConnect.php');
$conn = connectDb();

if (
    isset($_POST['id'], $_POST['username'], $_POST['email']) &&
    is_numeric($_POST['id'])
) {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $id);

    if ($stmt->execute()) {
        header("Location: userlist.php?success=1");
    } else {
        header("Location: updateUser.php?id=$id&error=1");
    }

    $stmt->close();
} else {
    header("Location: viewuser.php?invalid=1");
}

$conn->close();
