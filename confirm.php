<?php
// array errors
$errors = [];

// Define allowed file types (you can modify this array according to your requirements)
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Example allowed file types

// Maximum file size allowed in bytes (here, it's set to 5MB)
$maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

if ($_FILES['image']['name']) {
  $file = $_FILES['image'];

  // File details
  $fileName = $file['name'];
  $fileSize = $file['size'];
  $fileType = $file['type'];

  // Check file size
  if ($fileSize > $maxFileSize) {
    $errors['fileSize'] = "Your image error. File size is too large. Maximum size allowed is 5MB.";
  } else {
    // Check file type
    if (!in_array($fileType, $allowedTypes)) {
      $errors['fileType'] = "Your image error. Invalid file type. Allowed file types are: " . implode(', ', $allowedTypes);
    }
  }
  // Display image as HTMl
  $imagePath = $_FILES['image']['tmp_name'];
  $imageName = $_FILES['image']['name'];
  if (file_exists($imagePath)) {
    $imageInfo = getimagesize($imagePath); // Get image information
    $imageType = $imageInfo['mime']; // Get the image MIME type
  }
}
if ($_FILES['image02']['name']) {
  $file02 = $_FILES['image02'];

  // File details
  $fileName02 = $file02['name'];
  $fileSize02 = $file02['size'];
  $fileType02 = $file02['type'];

  // Check file size
  if ($fileSize02 > $maxFileSize) {
    $errors['fileSize02'] = "Your image 02 error. File size is too large. Maximum size allowed is 5MB.";
  } else {
    // Check file type
    if (!in_array($fileType02, $allowedTypes)) {
      $errors['fileType02'] = "Your image 02 error. Invalid file type. Allowed file types are: " . implode(', ', $allowedTypes);
    }
  }
  // Display image as HTML
  $imagePath02 = $_FILES['image02']['tmp_name'];
  $imageName02 = $_FILES['image02']['name'];
  if (file_exists($imagePath02)) {
    $imageInfo02 = getimagesize($imagePath02); // Get image information
    $imageType02 = $imageInfo02['mime']; // Get the image MIME type
  }
}

// errors
$hasError = false;
$hasErrorImage = false;
$hasErrorImage02 = false;
if (count($errors) > 0) {
  $hasError = true;
}

if ($errors['fileSize'] || $errors['fileType']) {
  $hasErrorImage = true;
}
if ($errors['fileSize02'] || $errors['fileType02']) {
  $hasErrorImage02 = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
  <link rel="stylesheet" href="./scss/app.css">
  <title>Confirm information</title>
</head>

<body>
  <div class="c-form01-wrap">
    <h1 class="title">Confirm information</h1>
    <div class="c-form01-wrap">
      <?php if ($hasError) : ?>
        <ul class="errors-list">
          <?php foreach ($errors as $error) : ?>
            <li class="errors-list__item"><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <form action="sendemail.php" method="POST" class="js-c-form01 c-form01 is-confirm" enctype="multipart/form-data">
        <div class="c-form01-row">
          <label class="c-form01-label" for="title">
            <span class="c-form01-label__txt">Your title</span>
          </label>
          <div class="c-form01-field">
            <?php echo $_POST['title']; ?>
            <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
          </div>
        </div>
        <div class="c-form01-row">
          <label class="c-form01-label" for="email">
            <span class="c-form01-label__txt">Your email</span>
          </label>
          <div class="c-form01-field">
            <?php echo $_POST['email']; ?>
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
          </div>
        </div>
        <div class="c-form01-row">
          <label class="c-form01-label">
            <span class="c-form01-label__txt">Your sex</span>
          </label>
          <div class="c-form01-field">
            <?php echo $_POST['sex']; ?>
            <input type="hidden" name="sex" value="<?php echo $_POST['sex']; ?>">
          </div>
        </div>
        <div class="c-form01-row">
          <label class="c-form01-label" for="choose">
            <span class="c-form01-label__txt">Your choose</span>
          </label>
          <div class="c-form01-field">
            <?php echo $_POST['choose']; ?>
            <input type="hidden" name="choose" value="<?php echo $_POST['choose']; ?>">
          </div>
        </div>
        <div class="c-form01-row">
          <label class="c-form01-label" for="phone">
            <span class="c-form01-label__txt">Your phone</span>
          </label>
          <div class="c-form01-field">
            <?php echo $_POST['phone']; ?>
            <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
          </div>
        </div>
        <div class="c-form01-row">
          <label class="c-form01-label" for="message">
            <span class="c-form01-label__txt">Your message</span>
          </label>
          <div class="c-form01-field is-full">
            <?php echo $_POST['message']; ?>
            <input type="hidden" name="message" value="<?php echo $_POST['message']; ?>">
          </div>
        </div>
        <?php if ($_FILES['image']['name'] && !$hasErrorImage) : ?>
          <div class="c-form01-row">
            <label class="c-form01-label">
              <label class="c-form01-label__txt">Your image</label>
            </label>
            <div class="c-form01-field">
              <?php
              $imageDataUrl = "data:$imageType;base64," . base64_encode(file_get_contents($imagePath));
              ?>
              <img src="<?php echo $imageDataUrl; ?>" alt="">
              <input type="hidden" name="imageDataUrl" value="<?php echo $imageDataUrl; ?>">
              <input type="hidden" name="imageName" value="<?php echo $imageName; ?>">
            </div>
          </div>
        <?php endif; ?>
        <?php if ($_FILES['image02']['name'] && !$hasErrorImage02) : ?>
          <div class="c-form01-row">
            <label class="c-form01-label">
              <label class="c-form01-label__txt">Your image 02</label>
            </label>
            <div class="c-form01-field">
              <?php
              $imageDataUrl02 = "data:$imageType02;base64," . base64_encode(file_get_contents($imagePath02));
              ?>
              <img src="<?php echo $imageDataUrl02; ?>" alt="">
              <input type="hidden" name="imageDataUrl02" value="<?php echo $imageDataUrl02; ?>">
              <input type="hidden" name="imageName02" value="<?php echo $imageName02; ?>">
            </div>
          </div>
        <?php endif; ?>
        <div class="c-form01-row is-full">
          <a href="javascript: history.go(-1)" class="c-form01-button is-back">Back</a>
          <button type="submit" class="js-c-submit-confirm c-form01-button">Submit</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>