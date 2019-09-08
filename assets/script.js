// When document is finish load of page and ready run it function
$(document).ready(function() {
	// GET baseUrl from the id
	let baseUrl = $("#baseUrl").val();

	// Run Data Table function with ServerSide Call AJAX function post and several parameter
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

	// IF button tambahData click run function
	$("#tambahData").on("click", function() {
		resetModalData();
		// fill in the html attribut id buttonModal with button tambahData
		$("#buttonModal").html(`
			<button type="button" class="btn btn-primary" id="tambahkan" onclick="tambah()"> TambahKan </button>
		`);
		cekData();
	});

	// Identify the edit Data From the parent td parent tbody and parent dataTable
	// and if click the button editData run function
	$("#dataTable > tbody").on("click", "td > #editData", function () {
		// Get every data from the row which clicked
		let barang = $.trim($(this).parent("td").parent("tr").find("td").eq(1).html());
		let harga = $.trim($(this).parent("td").parent("tr").find("td").eq(2).html());
		var id = $(this).attr("data-id");

		// Reset and fill the form input barang and harga
		resetModalData();
		$("#barang").val(barang);
		$("#harga").val(harga);

		// fill element id buttonModal with button update
		$("#buttonModal").html(`
			<button type="button" class="btn btn-primary" id="update" onclick="update(`+id+`)"> Update </button>
		`);

		cekData();
	});

	// Identify element showHapus parent td parent tbody and parent dataTable
	$("#dataTable > tbody").on("click", "td > #showHapus", function () {
		// Get attribut data-id from the row clicked
		var id = $(this).attr("data-id");
		// and the element button hapusData clicked run function hapus with parameter id
		$("#hapusData").on("click", function() {
			hapus(id);
		});
	});

});

// Function tambah used prepare the every data from form input and send the function kirim Data
function tambah() {
	let url = "Data/tambah";
	let barang = $("#barang").val();
	let harga = $("#harga").val();
	let data = {
		"barang" : barang,
		"harga" : harga
	}
	kirimData(url, data, "Tambah");
}

// Function update used prepare the every data from form input and send the function kirim Data
function update(id_barang) {
	let url = "Data/update";
	let barang = $("#barang").val();
	let harga = $("#harga").val();
	let data = {
		"id_barang" : id_barang,
		"barang" : barang,
		"harga" : harga
	}
	kirimData(url, data, "Update");
}

// Function hapus used prepare the every data from form input and send the function kirim Data
function hapus(id_barang) {
	let url = "Data/hapus";
	let data = {
		id_barang : id_barang
	};
	kirimData(url, data, "Hapus");
}

// Function kirim Data will send of the data to server with several parameter
// used ajax function and type of post
function kirimData(url, data, message) {
	let baseUrl = $("#baseUrl").val();
	let dataTable = $("#dataTable").DataTable();

	$.ajax({
		type : "POST",
		url : baseUrl+url,
		data : data,
		success : function(response) {
			if (response==-1){
				alert("Lengkapi Data");
			}
			else if (response==0){
				alert("Terjadi Kesalahan Di Server");
			}
			else {
				$("#modalData").modal("hide");
				$("#modalHapus").modal("hide");
				dataTable.ajax.reload();
				alert(message+" Berhasil");
			}
		}
	})
}

// Function setModelData used of set default value of form modalData
function resetModalData() {
	$("#barang").val("");
	$("#harga").val("");
	$("#errBarang").html("");
	$("#errHarga").html("");
}

// Function setModelData used checking of form that will be send to the server
// With all require of form and not null value if null show error and not null remove error
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