<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

class UserFactory {
    public static function getUserByEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}

class ResultFactory {
    public static function getResultsByUserId($conn, $userid) {
        $stmt = $conn->prepare("SELECT * FROM result WHERE user_id = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        $results = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $user = UserFactory::getUserByEmail($conn, $email);

    if ($user) {
        echo "<h4>Name: " . $user['first_name'] . " " . $user['last_name'] . "</h4>";
        echo "<h4>Age: " . $user['age'] . "</h4>";
        echo "<h4>Email: " . $user['email'] . "</h4>";
        echo "<h4>ID: " . $user['user_id'] . "</h4";

        $results = ResultFactory::getResultsByUserId($conn, $user['user_id']);

        if (!empty($results)) {
            foreach ($results as $row) {
                echo "<div style='border: 2px solid black;'>";
                echo "<p>Result ID: " . $row['result_id'] . "</p>";
                echo "<p>Result: " . $row['result'] . "</p>";
                echo "<h4>Date Taken: " . $row['created_at'] . "</h4>";
                echo "</div>";
            }
        } else {
            echo "No results found for the user.";
        }
    } else {
        echo "User not found in the database.";
    }

    $conn->close();
} else {
    echo "Email not found in the session.";
}
?>