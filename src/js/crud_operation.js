$(document).ready(function () {
	listUsers();
	$('#listUserTable').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bFilter": false,
		"bLengthChange": false,
		"pageLength": 5
	});
	// list all user in datatable
	function listUsers() {
		$.ajax({
			type: 'ajax',
			url: 'Staff_Gudang/tabel_surat_jalan',
			async: false,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var i;
				var no = 1;
			//	for (i = 0; i < data.length; i++) {
					html += 'ads';
				//}
				$('#listUser').html(html);
			}

		});
	
	}
	// save new user record
	$('#tombol-simpan').submit('click', function () {
		alert('adsd');
		var no_dokumen = $('#no_dokumen').val();
		var no_so = $('#no_so').val();
		var no_do = $('#no_do').val();
		var type_sj = $('#type_sj').val();
		var tgl = $('#tgl').val();
		var tgl = $('#nama_barang').val();
		var sak = $('#sak').val();
		var kg = $('#kg').val();
		var total_kg = $('#total_kg').val();
		$.ajax({
			type: "POST",
			url: "Staff_Gudang/simpan_surat_jalan",
			dataType: "JSON",
			data: { no_dokumen: no_dokumen, no_do: no_do, no_so: no_so,type_sj: type_sj,tgl:tgl,nama_barang:nama_barang,sak:sak,kg:kg,total_kg:total_kg },
			success: function (data) {
				location.reload(true);
				$('#sak').val("");
				$('#kg').val("");
				$('#nama_barang').val("");
			//	$('#addUserModal').modal('hide');
				listUsers();
			}
		});
		return false;
	});

	// show edit modal form with user data
	$('#listUser').on('click', '.editRecord', function () {
		$('#editUserModal').modal('show');
		$("#userId").val($(this).data('id'));
		$("#usernameEdit").val($(this).data('username'));
		$("#emailEdit").val($(this).data('email'));
	});
	// save edit record
	$('#editUserForm').on('submit', function () {
		var id = $('#userId').val();
		var username = $('#usernameEdit').val();
		var email = $('#emailEdit').val();
		$.ajax({
			type: "POST",
			url: "user/update",
			dataType: "JSON",
			data: { id: id, username: username, email: email },
			success: function (data) {
				$("#userId").val("");
				$("#usernameEdit").val("");
				$('#emailEdit').val("");
				$('#editUserModal').modal('hide');
				listUsers();
			}
		});
		return false;
	});
	// show delete modal
	$('#listUser').on('click', '.deleteRecord', function () {
		var UserId = $(this).data('id');
		$('#deleteUserModal').modal('show');
		$('#deleteUserId').val(UserId);
	});
	// delete user record
	$('#deleteUserForm').on('submit', function () {
		var UserId = $('#deleteUserId').val();
		$.ajax({
			type: "POST",
			url: "user/hapus",
			dataType: "JSON",
			data: { id: UserId },
			success: function (data) {
				$("#" + UserId).remove();
				$('#deleteUserId').val("");
				$('#deleteUserModal').modal('hide');
				listUsers();
			}
		});
		return false;
	});
});
