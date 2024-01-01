<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
  <link rel="stylesheet" href="./scss/app.css">
  <title>PHPMailer Testing</title>
</head>

<body>
  <h1 class="title">PHP Mailer</h1>
  <div class="c-form01-wrap">
    <form action="confirm.php" method="POST" class="js-c-form01 c-form01" enctype="multipart/form-data">
      <div class="c-form01-row">
        <label class="c-form01-label" for="title">
          <span class="c-form01-label__txt">Your title</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field">
          <input type="text" name="title" id="title" class="c-form01-input">
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label" for="email">
          <span class="c-form01-label__txt">Your email</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field">
          <input type="email" name="email" id="email" class="c-form01-input">
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label">
          <span class="c-form01-label__txt">Your sex</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field">
          <div class="c-form01-group">
            <input type="radio" id="male" name="sex" value="Male" class="c-form01-input">
            <label for="male">Male</label>
          </div>
          <div class="c-form01-group">
            <input type="radio" id="female" name="sex" value="Female" class="c-form01-input">
            <label for="female">Female</label>
          </div>
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label" for="choose">
          <span class="c-form01-label__txt">Your choose</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field">
          <select name="choose" id="choose" class="c-form01-input">
            <option value="">Please choose</option>
            <option value="saab">Saab</option>
            <option value="mercedes">Mercedes</option>
            <option value="audi">Audi</option>
          </select>
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label" for="phone">
          <span class="c-form01-label__txt">Your phone</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field">
          <input type="tel" name="phone" id="phone" class="c-form01-input is-tel">
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label" for="message">
          <span class="c-form01-label__txt">Your message</span>
          <span class="c-form01-label__required">Required</span>
        </label>
        <div class="c-form01-field is-full">
          <textarea name="message" id="message" class="c-form01-input is-textarea"></textarea>
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label">
          <label class="c-form01-label__txt">Your image</label>
        </label>
        <div class="c-form01-field">
          <input type="file" name="image" class="c-form01-input is-image" />
        </div>
      </div>
      <div class="c-form01-row">
        <label class="c-form01-label">
          <label class="c-form01-label__txt">Your image 02</label>
        </label>
        <div class="c-form01-field">
          <input type="file" name="image02" class="c-form01-input is-image" />
        </div>
      </div>
      <div class="c-form01-row is-full">
        <div class="c-form01-field">
          <div class="c-form01-group">
            <input type="checkbox" id="agree" name="agree" class="c-form01-input" />
            <label for="agree">Are you agree with our policy?</label>
          </div>
          <span class="js-c-form01-message c-form01-error"></span>
        </div>
      </div>
      <div class="c-form01-row is-full">
        <button type="submit" class="js-c-submit c-form01-button">submit</button>
      </div>
    </form>
  </div>
  <script src="./js/validator.js"></script>
  <script>
    Validator({
      form: '.js-c-form01',
      formMessage: '.js-c-form01-message',
      rules: [
        Validator.isRequired('#title'),
        Validator.isRequired('#email'),
        Validator.isEmail('#email'),
        Validator.isRequired("#message"),
        Validator.isRequired("#phone"),
        Validator.isNumber("#phone"),
        Validator.minLength("#phone", 10),
      ],
      listChecked: ['sex', 'agree'],
      listSelected: ['choose'],
    });
  </script>
</body>

</html>