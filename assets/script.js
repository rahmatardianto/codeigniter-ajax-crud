$(document).ready(function() {
	let baseUrl = $("#baseUrl").val();

	$("#dataTable").DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
			url: baseUrl+"Data/ambilData",
			type : "POST"

			// For Debugging
			// "data":function(outData){
			//     // what is being sent to the server
			//     console.log(outData);
			//     return outData;
			// },
			// dataFilter:function(inData){
			//     // what is being sent back from the server (if no error)
			//     console.log(inData);
			//     return inData;
			// },
			// error:function(err, status){
			//     // what error is seen(it could be either server side or client side.
			//     console.log(err);
			// },
	     }
    });

	$("#tambahData").on("click", function() {
		$("#buttonModal").html(`
			<button type="button" class="btn btn-primary" id="tambahkan" onclick="tambah()"> TambahKan </button>
		`);
		cekData();
	});

	$("#editData").on("click", function() {
		$("#buttonModal").html(`
			<button type="button" class="btn btn-primary" id="update" onclick="update()"> Update </button>
		`);
		cekData();
	});
});

function tambah() {

}

function kirimData(type) {
	let baseUrl = $("#baseUrl").val();
	let barang = $("#barang").val();
	let harga = $("#harga").val();

	$.ajax({
		type : "POST",
		url : baseUrl,
		data : {
			barang : barang,
			harga : harga,
		},
		success : function(response) {
			if (response==-1){
				alert("Lengkapi Data");
			}
			else if (response==0){
				alert("Terjadi Kesalahan Di Server");
			}
			else {				
				$("#modalData").modal("toggle");
				alert("Berhasil");
			}
		}
	})
}

function cekData() {
	$("#barang").focusout(function() {
		if ($(this).val()=="") {
			$("#errBarang").html("Barang Tidak Boleh Kosong");
		}
		else {
			$("#errBarang").html("");
		}
	});
	$("#harga").focusout(function() {
		if ($(this).val()=="") {
			$("#errHarga").html("Harga Tidak Boleh Kosong");
		}
		else {
			$("#errHarga").html("");
		}
	});
}