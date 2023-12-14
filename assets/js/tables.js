$(document).ready(function () {
	$("#example").DataTable({
		aLengthMenu: [
			[3, 5, 10, -1],
			[3, 5, 10, "All"],
		],
		iDisplayLength: 3,
	});
});
