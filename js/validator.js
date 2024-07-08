var Validator = function (options) {
  var formElement = document.querySelector(options.form);
  var selectorRules = {};
  
  // submit form
  if (formElement) {
    formElement.onsubmit = function(e) {
      e.preventDefault();
      var isFromError = false;
      
      options.rules.forEach(function(rule) {
        var inputElement = document.querySelector(rule.selector);
        isError = validate(inputElement, rule);
        if (isError) {
          isFromError = true;
        }
      });
      
      // check is checked
      var isCheckedSex = Validator.isChecked('sex');
      var isCheckedAgree = Validator.isChecked('agree');
      var isSelectedChoose = Validator.isSelected('choose');
      
      if (!isFromError && isCheckedSex && isCheckedAgree && isSelectedChoose) {
        formElement.submit();
      } else {
        console.log('form error...');
        
        // Scroll to the top of the page
        function scrollToTop() {
          // Scroll to the top with smooth behavior (if supported)
          if ('scrollBehavior' in document.documentElement.style) {
            window.scrollTo({
              top: 0,
              behavior: 'smooth'
            });
          } else {
            // For browsers that don't support smooth scrolling
            window.scrollTo(0, 0);
          }
        }

        // scrolling when the form have error
        let elements = document.querySelectorAll('.c-form01-row.is-invalid');
        if (elements.length === 1) {
          let element = document.querySelector('.c-form01-row.is-invalid');
          element.scrollIntoView({ behavior: 'smooth' });
        } else {
          scrollToTop();
        }
      }
    }
  }
  
  // validate form
  if (formElement) {
    options.rules.forEach(function(rule) {
      var inputElement = document.querySelector(rule.selector);
      var errorElement = inputElement.parentElement.querySelector(options.formMessage);
      
      // save rules of the input
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.check);
      } else {
        selectorRules[rule.selector] = [rule.check];
      }
    
      if (inputElement) {
        inputElement.onblur = function() {
          // validate input
          validate(inputElement, rule);
        }
        inputElement.oninput = function() {
          errorElement.innerText = '';
          inputElement.parentElement.parentElement.classList.remove("is-invalid");
        }
      }
    });
    
    // check checked
    options.listChecked.forEach(function(item) {
      var inputElementsCheck = document.getElementsByName(item);
      inputElementsCheck.forEach(function(inputElement){
        inputElement.onchange = function() {
          Validator.isChecked(inputElement.name);
        }
      })
    })
    
    // check selected
    options.listSelected.forEach(function(item) {
      var inputElementsSelect = document.getElementsByName(item);
      inputElementsSelect.forEach(function(inputElement){
        inputElement.onchange = function() {
          Validator.isSelected(inputElement.name);
        }
      })
    })
  }
  
  // validate input function
  function validate(inputElement, rule) {
    var rules = selectorRules[rule.selector];
    var errorElement = "";
    var errorMessage = "";

    errorElement = inputElement.parentElement.querySelector(
      options.formMessage
    );
    
    for (let i = 0; i < rules.length; i++) {
      errorMessage = rules[i](inputElement.value);
      if (errorMessage) {
        break;
      }
    }
    
    if (errorMessage) {
      errorElement.innerText = errorMessage;
      inputElement.parentElement.parentElement.classList.add('is-invalid');
      inputElement.parentElement.parentElement.classList.remove('is-valid');
    } else {
      inputElement.parentElement.parentElement.classList.remove('is-invalid');
      inputElement.parentElement.parentElement.classList.add('is-valid');
    }
    return errorMessage;
  }
}

Validator.isRequired = function(selector) {
  return {
    selector,
    check: function(value) {
      return value.trim() ? undefined : 'Please enter this field';
    }
  }
}

Validator.isEmail = function (selector) {
  return {
    selector,
    check: function (value) {
      var regular = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regular.test(value) ? undefined : "This field must be email";
    },
  };
}

Validator.minLength = function (selector, min) {
  return {
    selector,
    check: function (value) {
      return value.length >= min
        ? undefined
        : `Phone length is at least ${min} characters`;
    },
  };
}

Validator.isNumber = function (selector) {
  return {
    selector,
    check: function (value) {
      var regular = /^[0-9]+$/;
      return regular.test(value) ? undefined : "This field must be number";
    },
  };
}

Validator.isChecked = function (name) {
  var radios = document.getElementsByName(name);
  var checkedValue = null;
  var errorElementCheck = '';
  
  for (var i = 0; i < radios.length; i++) {
    errorElementCheck = radios[i].parentElement.parentElement.querySelector('.js-c-form01-message');
    
    if (radios[i].checked) {
      checkedValue = radios[i].value;
      break;
    }
  }
  
  if (!checkedValue) {
    errorElementCheck.parentElement.parentElement.classList.add('is-invalid');
    errorElementCheck.parentElement.parentElement.classList.remove('is-valid');
    errorElementCheck.innerText = 'Please choose this field';
  } else {
    errorElementCheck.parentElement.parentElement.classList.remove('is-invalid');
    errorElementCheck.parentElement.parentElement.classList.add('is-valid');
    errorElementCheck.innerText = '';
  }
  
  return checkedValue;
}

Validator.isSelected = function (name) {
  var selects = document.getElementsByName(name);
  var selectedValue = '';
  var errorElementSelect = '';
  
  for (var i = 0; i < selects.length; i++) {
    errorElementSelect = selects[i].parentElement.parentElement.querySelector('.js-c-form01-message');
    selectedValue = selects[i].value;
  
    if (selectedValue !== '') {
      selectedValue = selects[i].value;
      break;
    }
  }
  
  if (!selectedValue) {
    errorElementSelect.parentElement.parentElement.classList.add('is-invalid');
    errorElementSelect.parentElement.parentElement.classList.remove('is-valid');
    errorElementSelect.innerText = 'Please choose this field';
  } else {
    errorElementSelect.parentElement.parentElement.classList.remove('is-invalid');
    errorElementSelect.parentElement.parentElement.classList.add('is-valid');
    errorElementSelect.innerText = '';
  }
  
  return selectedValue;
}