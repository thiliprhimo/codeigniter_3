$("#register_form").submit((event) => {
	event.preventDefault();

	let name = $("#name").val();
	let email = $("#email").val();
	let password = $("#password").val();
	if (name == "") {
		displayError("Name shouldn't be empty!");
		return false;
	}
	if (email == "") {
		displayError("Email shouldn't be empty!");
		return false;
	}
	if (password == "") {
		displayError("Password shouldn't be empty!");
		return false;
	}

	const formURL = $("#register_form").attr("action");
	let formData = $("#register_form").serialize();

	$.ajax({
		url: formURL,
		type: "POST",
		data: formData,
		dataType: "json",
		beforeSend: function () {
			$(".error").text("Loading.....").show();
			$(".lock").attr("readonly", true);
		},
		success: function (response) {
			if (response.error == true) {
				displayError(response.message);
				$(".lock").attr("readonly", false);
				return false;
			}
			location.href = response.redirect;
		},
		error: function (error) {
			alert(error);
		},
	});
});

function displayError(errorMsg) {
	$(".error").text(errorMsg);
	$(".error").show();
}
