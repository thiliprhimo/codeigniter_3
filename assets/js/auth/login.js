$("#login_form").on("submit", (event) => {
	event.preventDefault();

	let username = $("#username").val();
	let password = $("#password").val();
	if (username == "") {
		displayError("Username can't be empty!");
		$("#username").focus();
		return false;
	}
	if (password == "") {
		displayError("Password can't be empty!");
		$("#password").focus();
		return false;
	}

	const loginURL = $("#login_form").attr("action");
	let formData = $("#login_form").serialize();

	$.ajax({
		url: loginURL,
		type: "POST",
		data: formData,
		dataType: "json",
		success: function (response) {
			if (response.error == true) {
				displayError(response.message);
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
