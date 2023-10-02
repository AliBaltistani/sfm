


<!-- BOOTSTRAP SCRIPTS -->
<script src="../js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="../js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../js/custom1.js"></script>

<script type="text/javascript">


	$(document).ready(function () {

		$("#signupForm1").validate({
			rules: {
				oldpassword: "required",

				newpassword: {
					required: true,
					minlength: 6
				},

				confirmpassword: {
					required: true,
					minlength: 6,
					equalTo: "#newpassword"
				}
			},
			messages: {
				oldpassword: "Please enter your old password",

				newpassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				confirmpassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Please enter the same password as above"
				}
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `help-block` class to the error element
				error.addClass("help-block");

				// Add `has-feedback` class to the parent div.form-group
				// in order to add icons to inputs
				element.parents(".col-sm-5").addClass("has-feedback");

				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.parent("label"));
				} else {
					error.insertAfter(element);
				}

				// Add the span element, if doesn't exists, and apply the icon classes to it.
				if (!element.next("span")[0]) {
					$("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
				}
			},
			success: function (label, element) {
				// Add the span element, if doesn't exists, and apply the icon classes to it.
				if (!$(element).next("span")[0]) {
					$("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
				$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
				$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
			}
		});
	});
</script>


</body>

</html>