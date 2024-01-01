var Validator = function (options) {
  var formElement = document.querySelector(options.form);
  var selectorRules = {};
  
  console.log('hello 02');

  // When submit form
  formElement.onsubmit = function (e) {
    console.log('hello 03');
    
    e.preventDefault();
    var isFromError = false;
    options.rules.forEach(function (rule) {
      var inputElement = document.querySelector(rule.selector);
      var isError = validate(inputElement, rule);
      if (isError) {
        isFromError = true;
      }
    });
    if (!isFromError) {
      // Submit form by html default
      formElement.submit();
    }
  };

  // Function validate
  function validate(inputElement, rule) {
    console.log('hello 04');
    
    var errorElement = "";
    var errorMessage = "";

    errorElement = inputElement.parentElement.querySelector(
      options.formMessage
    );

    var rules = selectorRules[rule.selector];
    for (var i = 0; i < rules.length; i++) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) {
        break;
      }
    }

    if (errorMessage) {
      errorElement.innerText = errorMessage;
      inputElement.parentElement.parentElement.classList.add("is-invalid");
      inputElement.parentElement.parentElement.classList.remove("is-valid");
    } else {
      errorElement.innerText = "";
      inputElement.parentElement.parentElement.classList.remove("is-invalid");
      inputElement.parentElement.parentElement.classList.add("is-valid");
    }

    return !!errorMessage;
  }

  // Validate form
  if (formElement) {
    console.log('hello 05');
    
    options.rules.forEach(function (rule) {
      var inputElement = document.querySelector(rule.selector);
      var errorElement = inputElement.parentElement.querySelector(
        options.formMessage
      );

      // Lưu lại các rule của input
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.check);
      } else {
        selectorRules[rule.selector] = [rule.check];
      }

      if (inputElement) {
        inputElement.onblur = function () {
          validate(inputElement, rule);
        };
        inputElement.oninput = function () {
          errorElement.innerText = "";
          inputElement.parentElement.parentElement.classList.remove("is-invalid");
        };
      }
    });
    
    console.log('selectorRules: ', selectorRules);
  }
};

Validator.isRequired = function (selector) {
  console.log('hello isRequired', selector);
  
  return {
    selector,
    check: function (value) {
      return value.trim() ? undefined : "Please enter this field";
    },
  };
};

Validator.isEmail = function (selector) {
  return {
    selector,
    check: function (value) {
      var regular = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regular.test(value) ? undefined : "This field must be email";
    },
  };
};

Validator.minLength = function (selector, min) {
  return {
    selector,
    check: function (value) {
      return value.length >= min
        ? undefined
        : `Phone length is at least ${min} characters`;
    },
  };
};

Validator.isNumber = function (selector) {
  return {
    selector,
    check: function (value) {
      var regular = /^[0-9]+$/;
      return regular.test(value) ? undefined : "This field must be number";
    },
  };
};