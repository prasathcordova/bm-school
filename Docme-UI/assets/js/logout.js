//** Auto logout script starts
var timer = 0;
var timer_confirm = 0;

function auto_logout() {
  var url = baseurl + "/logout";
  // this function will redirect the user to the logout script
  window.location = url;
}
function auto_logout_confirm() {
  clearInterval(timer);
  timer = setInterval("auto_logout()", 6000);
  swal(
    {
      title: "Are you still there?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d63511",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "No, Logout",
      cancelButtonText: "Yes, Retain Me",
      closeOnConfirm: false
    },
    function (isconfirm) {
      if (isconfirm) {
        window.location.href = baseurl + "/logout";
      } else {
        reset_interval();
      }
    }
  );
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer
  if (timer != 0) {
    clearInterval(timer);
    // second step: implement the timer again //900000
    timer = setInterval("auto_logout_confirm()", 900000);
  }
}

jQuery(function ($) {
  $("body").ready(function () {
    timer = setInterval("auto_logout_confirm()", 900000);
  });

  $("body").on("scroll", function () {
    reset_interval();
  });

  $("body").on("keypress", function () {
    reset_interval();
  });

  $("body").on("mousemove", function () {
    reset_interval();
  });

  $("body").on("click", function () {
    reset_interval();
  });
});
//**Auto logout script ends

//**Common Javascript Functions Start */

function getRoundoff(amount, country) {
  int_part = Math.trunc(amount); // returns 3
  float_part = Number((amount - int_part).toFixed(2)); // return 0.2

  if (country == "INDIA") {
    if (float_part >= 0.5) {
      // if greater than or equal to 0.5 => round off to top
      ret_amount = int_part * 1 + 1 * 1;
    } else if (float_part < 0.5) {
      // if less than 0.5 => round off to bottom
      ret_amount = int_part;
    } else {
      ret_amount = amount;
    }
  } else if (country == "UAE") {
    if (float_part <= 0.1) {
      ret_amount = int_part;
    } else if (float_part > 0.1 && float_part <= 0.25) {
      ret_amount = int_part * 1 + 0.25 * 1;
    } else if (float_part > 0.25 && float_part <= 0.5) {
      ret_amount = int_part * 1 + 0.5 * 1;
    } else if (float_part > 0.5 && float_part <= 0.75) {
      ret_amount = int_part * 1 + 0.75 * 1;
    } else if (float_part > 0.75 && float_part <= 0.99) {
      ret_amount = int_part * 1 + 1 * 1;
    }
  }
  return ret_amount;
}

function logout_confirm() {
  swal(
    {
      title: "",
      text: "Are you sure to log out from the application?",
      type: "warning",
      showCancelButton: true,
      cancelButtonColor: "#d33",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      closeOnConfirm: false
    },
    function (isconfirm) {
      if (isconfirm) {
        window.location.href = baseurl + "/logout";
      }
    }
  );
}

//**Common Javascript Functions End */

jQuery(function ($) {
  //**Script for Duplicate Window Start

  if (window.IsDuplicate()) {
    // alert("This is duplicate window\n\n Closing...");
    // window.opener = self;
    // window.close();
    // Wrap in an IIFE accepting jQuery as a parameter.
    var setCookie,
      removeCookie,
      // Create constants for things instead of having same string
      // in multiple places in code.
      COOKIE_NAME = "TabOpen",
      SITE_WIDE_PATH = { path: "/" };

    setCookie = function () {
      $.cookie(COOKIE_NAME, "1", SITE_WIDE_PATH);
    };

    removeCookie = function () {
      $.removeCookie(COOKIE_NAME, SITE_WIDE_PATH);
    };

    // We don't need to wait for DOM ready to check the cookie
    if (COOKIE_NAME === undefined) {
      setCookie();
      $(window).unload(removeCookie);
    } else {
      // Replace the whole body with an error message when the DOM is ready.
      $(function () {
        $("body").html(
          '<div class="error" style="text-align:center;margin-top:15%">' +
          "<h1>Sorry!</h1>" +
          "<p>You can only have one instance of this web page open at a time.</p>" +
          "</div>"
        );
      });
    }
  }


  //**Script for Duplicate Window End

  //**Other Common Jquery Start

  // For Textbox Focusing in a Page
  $(document).on("focus", ".admnNumberCheck", function () {
    $(this).attr("maxlength", "10");
  });
  $(document).on("focus", ".max20", function () {
    $(this).attr("maxlength", "20");
  });
  $(document).on("focus", ".max50", function () {
    $(this).attr("maxlength", "50");
  });
  $(document).on("focus", ".max60", function () {
    $(this).attr("maxlength", "60");
  });
  $(document).on(
    "focus",
    ".dataTables_filter input[type='search']",
    function () {
      $(this).attr("maxlength", "10");
    }
  );
  $(document).on("focus", ".decimalCheck", function () {
    $(this).attr("maxlength", "8");
  });

  $(document).on("focus", ".decimalCheck_perc", function () {
    $(this).attr("maxlength", "3"); //6 changed to 3
  });

  $(document).on("click", ".btn,a.sidemenulink", function () {
    $("input:text:visible:first")
      .not("#reportdate")
      .not("#datepicker")
      .not("#datefilter")
      .not(".nofocusitem")
      .not(".is-datepicker")
      .focus();
  });

  //PREVENTING PASTE DROP DRAG INTO TEXTBOX
  $(document).on("paste drag drop", ".disabledragpaste", function (e) {
    e.preventDefault();
  });

  // Validation of Textboxes
  $(document).on("keypress", ".numeric", function (e) {
    var dec_numbers = /[0-9]|\.+?$/;
    if (!dec_numbers.test(e.key)) {
      return false;
    } else {
      return true;
    }
  });
  $(document).on("keypress", ".digits", function (e) {
    var dec_numbers = /[0-9]+?$/;
    if (!dec_numbers.test(e.key)) {
      return false;
    } else {
      return true;
    }
  });
  $(document).on("keypress", ".numericDecimal", function (evt) {
    //$(".numericDecimal").on("keypress", function (evt) {
    var $txtBox = $(this);
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
      return false;
    } else {
      var len = $txtBox.val().length;
      var index = $txtBox.val().indexOf('.');
      if (index >= 0 && charCode == 46) {
        return false;
      }
      if (index >= 0) {
        var charAfterdot = (len + 1) - index;
        if (charAfterdot > 3) {
          return false;
        }
      }
    }
    return $txtBox; //for chaining
  });
  $(document).on("keypress", ".alphanumeric", function (e) {
    var alphanumeric = /[\w]|\-|\s+?$/;
    if (!alphanumeric.test(e.key)) {
      return false;
    } else {
      return true;
    }
  });
  $(document).on("keypress", ".alpha", function (e) {
    var alpha = /[a-zA-Z]|\-|\s+?$/;
    if (!alpha.test(e.key)) {
      return false;
    } else {
      return true;
    }
  });
  $(document).on("keypress", ".alphaNoSpace", function (e) {
    var alphaNoSpace = /^[a-zA-Z0-9]*$/;
    if (!alphaNoSpace.test(e.key)) {
      return false;
    } else {
      return true;
    }
  });
  $(document).on("keypress", ".admnNumberCheck", function (e) {
    var regex = new RegExp("^[t-tT-T0-9/]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
      return true;
    }

    e.preventDefault();
    return false;
  });
  //Function to allow only Decimal values to textbox
  $(document).on("keypress", ".decimalCheck,.decimalCheck_perc", function (key) {
    //getting key code of pressed key
    var keycode = key.which ? key.which : key.keyCode;
    //comparing pressed keycodes
    if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
      return false;
    } else {
      //var parts = key.srcElement.value.split('.');
      var parts = $(this)
        .val()
        .split(".");
      if (parts.length > 1 && keycode == 46) return false;
      return true;
    }
  });
  //**Other Common Jquery End
});
