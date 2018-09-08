<!DOCTYPE html>
<html lang="en">
<head>
	<title>
            SRMWEclub &mdash; WeEntrepreneur club
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
<!--===============================================================================================-->	
	<link rel="icon"  href="wee.ico" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../login/css/main.css">
<!--===============================================================================================-->
<style>
* {
  box-sizing: border-box;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}
@media screen and (max-width: 320px) {
       .ind{
       width: 100%;
     }

}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #dc1414;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #dc1414;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #dc1414;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #dc1414;
}

.login_submit_button1{
    height: 40px;
    background: linear-gradient(to right,#d45a61,#ef0b0b);
    border: none;
    float: right;
    border-radius: 3px;
    color: white;
    font-weight:bold;
}

.login_submit_button1:hover{
    background-color: #ddd;
    cursor: pointer;
    background: linear-gradient(to right,#ef0b0b,#d45a61);
}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="check_signup.php" enctype="multipart/form-data">
					<span class="login100-form-title p-b-26">
						Welcome to <span style="font-size: 30px; color: #e53c2e;">SRMWE</span>Club
					</span>
					<span class="login100-form-title p-b-48">
						<img src="../img/wee.png" style="width: 80px;height: 80px;">
					</span>
				<div class="tab">
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="f_name" id="fn">
						<span class="focus-input100" data-placeholder="First Name (required)"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="l_name" id="ln">
						<span class="focus-input100" data-placeholder="Last Name(required)"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" id="em">
						<span class="focus-input100" data-placeholder="Email(required)"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="m_no" id="mno">
						<span class="focus-input100" data-placeholder="Mobile Number(required)"></span>
					</div>
				</div>
				<div class="tab">
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" id="pas">
						<span class="focus-input100" data-placeholder="Enter Password(required)"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="r_pass" id="rpas">
						<span class="focus-input100" data-placeholder="Retype Password(required)"></span>
					</div>
				</div>

				<div class="tab">
						<h5>Profile Picture (required)</h5>
				<br>
                <input name="img" type="file">
                <br>
						<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="signup">
								Create your account
							</button>
						</div>
					</div>
				</div>
					<br><br>
					<div style="overflow:auto;">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                  </div>

           <!-- Circles which indicates the steps of the form: -->
                  <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                  </div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Already have an account? 
						</span>

						<a class="txt2" href="../login">
							Log In
						</a>
					</div>

                <script>
                    var currentTab = 0; // Current tab is set to be the first tab (0)
                    showTab(currentTab); // Display the crurrent tab

                    function showTab(n) {
                      // This function will display the specified tab of the form...
                      var x = document.getElementsByClassName("tab");
                      x[n].style.display = "block";
                      //... and fix the Previous/Next buttons:
                      if (n == 0) {
                        document.getElementById("prevBtn").style.display = "none";
                      } else {
                        document.getElementById("prevBtn").style.display = "inline";
                      }
                      if (n == (x.length - 1)) {
                          document.getElementById("nextBtn").style.display = "none";

                      } else {
                        document.getElementById("nextBtn").innerHTML = "Next";
                      }
                      //... and run a function that will display the correct step indicator:
                      fixStepIndicator(n)
                    }

                    function nextPrev(n) {
                      // This function will figure out which tab to display
                      var x = document.getElementsByClassName("tab");
                      // Exit the function if any field in the current tab is invalid:
                      if (n == 1 && !validateForm()) return false;
                      // Hide the current tab:
                      x[currentTab].style.display = "none";
                      // Increase or decrease the current tab by 1:
                      currentTab = currentTab + n;
                      // if you have reached the end of the form...
                      if (currentTab >= x.length) {
                        // ... the form gets submitted:
                        document.getElementById("regForm").submit();
                        return false;
                      }
                      // Otherwise, display the correct tab:
                      showTab(currentTab);
                    }
                     function validateForm() {
                      // This function deals with validation of the form fields
                      var x, y, i, valid = true;
                      x = document.getElementsByClassName("tab");
                      y = x[currentTab].getElementsByTagName("input");
                      // A loop that checks every input field in the current tab:
                      for (i = 0; i < y.length; i++) {
                        // If a field is empty...
                        if (y[i].value == "") {
                          // add an "invalid" class to the field:
                          y[i].className += " invalid";
                          // and set the current valid status to false
                          valid = false;
                        }
                      }
                      // If the valid status is true, mark the step as finished and valid:
                      if (valid) {
                        document.getElementsByClassName("step")[currentTab].className += " finish";
                      }
                      return valid; // return the valid status
                    }


                    function fixStepIndicator(n) {
                      // This function removes the "active" class of all steps...
                      var i, x = document.getElementsByClassName("step");
                      for (i = 0; i < x.length; i++) {
                        x[i].className = x[i].className.replace(" active", "");
                      }
                      //... and adds the "active" class on the current step:
                      x[n].className += " active";
                    }
                    </script>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/bootstrap/js/popper.js"></script>
	<script src="../login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../login/js/main.js"></script>
<!--===============================================================================================-->
</body>
</html>