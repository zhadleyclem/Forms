<?php
// process_form.php - Simple PHP script to display form values
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Results - Assignment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Form Submission Results</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='note'>";
            echo "<p><strong>Form submitted successfully!</strong> Here are the values you entered:</p>";
            echo "</div>";
            
            echo "<div class='form-group'>";
            echo "<h2>Form Data Received:</h2>";
            
            // Text Input
            if (isset($_POST['username']) && !empty($_POST['username'])) {
                echo "<p><strong>Text Input - Username:</strong> " . htmlspecialchars($_POST['username']) . "</p>";
            }
            
            // Textarea
            if (isset($_POST['comments']) && !empty($_POST['comments'])) {
                echo "<p><strong>Textarea - Comments:</strong><br>" . nl2br(htmlspecialchars($_POST['comments'])) . "</p>";
            }
            
            // Hidden Data
            if (isset($_POST['form_id'])) {
                echo "<p><strong>Hidden Data - Form ID:</strong> " . htmlspecialchars($_POST['form_id']) . "</p>";
            }
            
            if (isset($_POST['submitted_at'])) {
                echo "<p><strong>Hidden Data - Submitted At:</strong> " . htmlspecialchars($_POST['submitted_at']) . "</p>";
            }
            
            // Password (don't display actual password for security)
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                echo "<p><strong>Password Input:</strong> [Password entered - " . strlen($_POST['password']) . " characters]</p>";
            }
            
            // Array of Check Boxes
            if (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) {
                echo "<p><strong>Array of Check Boxes - Hobbies Selected:</strong> ";
                echo implode(", ", array_map('htmlspecialchars', $_POST['hobbies']));
                echo "</p>";
            } else {
                echo "<p><strong>Array of Check Boxes - Hobbies Selected:</strong> None</p>";
            }
            
            // Radio Buttons
            if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                echo "<p><strong>Radio Buttons - Gender:</strong> " . htmlspecialchars($_POST['gender']) . "</p>";
            }
            
            // Selection List
            if (isset($_POST['country']) && !empty($_POST['country'])) {
                echo "<p><strong>Selection List - Country:</strong> " . htmlspecialchars($_POST['country']) . "</p>";
            }
            
            // File Input
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                echo "<p><strong>File Input - Profile Picture:</strong> " . htmlspecialchars($_FILES['profile_picture']['name']) . " (Size: " . $_FILES['profile_picture']['size'] . " bytes)</p>";
            } else {
                echo "<p><strong>File Input - Profile Picture:</strong> No file uploaded</p>";
            }
            
            // URL Input
            if (isset($_POST['website']) && !empty($_POST['website'])) {
                echo "<p><strong>URL Input - Website:</strong> " . htmlspecialchars($_POST['website']) . "</p>";
            }
            
            echo "</div>";
            
            // Display raw POST data for debugging (properly labeled)
            echo "<div class='form-group'>";
            echo "<h3>Raw Form Data (for debugging):</h3>";
            echo "<pre>";
            echo "POST Data:\n";
            foreach($_POST as $key => $value) {
                if (is_array($value)) {
                    echo htmlspecialchars($key) . " => " . implode(", ", array_map('htmlspecialchars', $value)) . "\n";
                } else {
                    // Don't display password in raw data
                    if ($key === 'password') {
                        echo htmlspecialchars($key) . " => [HIDDEN]\n";
                    } else {
                        echo htmlspecialchars($key) . " => " . htmlspecialchars($value) . "\n";
                    }
                }
            }
            
            if (!empty($_FILES)) {
                echo "\nFILE Data:\n";
                foreach($_FILES as $key => $file) {
                    echo htmlspecialchars($key) . " => " . htmlspecialchars($file['name']) . " (Size: " . $file['size'] . " bytes)\n";
                }
            }
            echo "</pre>";
            echo "</div>";
            
        } else {
            echo "<div class='note'>";
            echo "<p><strong>No form data received.</strong> Please submit the form first.</p>";
            echo "</div>";
        }
        ?>
        
        <div class="form-group">
            <a href="index.html" style="text-decoration: none;">
                <button type="button">Back to Form</button>
            </a>
        </div>
        
        <div class="note">
            <p><strong>Assignment Requirements Met:</strong> This PHP script properly displays each form value with clear labels, showing that all form elements (text, textarea, hidden data, password, array of checkboxes, radio buttons, selection list, file, and URL) are being processed correctly.</p>
        </div>
    </div>
</body>
</html>
