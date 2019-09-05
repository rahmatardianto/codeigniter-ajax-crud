<div class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div> -->

            <div class="card">
                <div class="card-body">
                    <button type="button" id="tambahData" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalData"> Tambah Data </button>
                    <table class="table text-center">
                        <thead>
                          <tr>
                            <th width="10">No</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th width="200">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Data</td>
                            <td>10000</td>
                            <td>
                                <button type="button" id="editData" class="btn btn-info" data-toggle="modal" data-target="#modalData"> Edit </button>
                                <button type="button" id="showHapus" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus"> Hapus </button>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Data -->
            <div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="modalData" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="barang"> Barang </label>
                        <input type="text" class="form-control" id="barang">
                    </div>
                    <div class="form-group">
                        <label for="harga"> Harga </label>
                        <input type="number" class="form-control" id="harga">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary"> TambahKan </button>
                    </div>
                </div>

              </div>
            </div>
          </div>

          <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapus" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Hapus Data
                    </div>
                    <div class="modal-body">
                        Data Akan Dihapus ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="hapusData">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>