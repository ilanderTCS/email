<?php
// Define variables to store user input and error messages
$name = $email = $message = $error = "";

// Function to sanitize and validate input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $error .= "Name is required.<br>";
    } else {
        $name = sanitize_input($_POST["name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error .= "Only letters and white space allowed in the name.<br>";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $error .= "Email is required.<br>";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Check if the email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format.<br>";
        }
    }

    // Validate message
    if (empty($_POST["message"])) {
        $error .= "Message is required.<br>";
    } else {
        $message = sanitize_input($_POST["message"]);
    }

    // If there are no validation errors, you can proceed with processing the form data
    if (empty($error)) {
        // Process the form data or save it to a database
        // ...
        // Redirect or display a success message
        header("Location: success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation Example</title>
</head>
<body>
<?php
$msg="";
    // Display validation error messages
    if (!empty($error)) {
        echo "<h3>Error:</h3><p>{$error}</p>";
    }
    ?>
    <h2>Contact Us</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <p><?php echo $msg;  ?></p>
        <br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <p><?php echo $msg;  ?></p>
        <br>

        <label for="message">Message:</label>
        <textarea name="message"><?php echo $message; ?></textarea>
        <p><?php echo $msg;  ?></p>
        <br>

        <input type="submit" value="Submit">
    </form>

   
</body>
</html>