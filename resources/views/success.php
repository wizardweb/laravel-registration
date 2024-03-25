<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>

<form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="text-danger"><?php echo $errors['name']; ?></div>
        <?php endif; ?>
    </div>
    <!-- Add other form fields here -->

    <button type="submit" class="btn btn-primary">Register</button>
</form>
    
</body>
</html>