<?=$this->extend('backend/template')?>

<?=$this->section('content')?>


            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
                
                <table id='table-siswa' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Status Masuk</th>
                            <th>Tahun Masuk</th>
                            <th>Nama Siswa</th>
                            <th>Kelas Sekarang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Data Siswa</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formSiswa" method="post" action="<?=base_url('pegawai/siswa') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control">
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Status Masuk</label>
                                <select name="status_masuk" class="form-control">
                                    <option value="A">Asal</option>
                                    <option value="P">Pindahan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun Masuk</label>
                                <input type="date" name="thn_masuk" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NO KK</label>
                                <input type="text" name="no_kk" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelas Sekarang</label>
                                <select name="kelas_id" class="form-control">
                                    <?php
                                        use App\Models\KelasModel;


                                        $r = (new KelasModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['tingkat']} {$k['kelas']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="no_telp_rumah" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Hp Ibu</label>
                                <input type="text" name="no_hp_ibu" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Hp Ayah</label>
                                <input type="text" name="no_hp_ayah" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nm_ayah" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nm_ibu" class="form-control">
                            </div>
                          
                            <div class="mb-3">
                                <label class="form-label">Nama Wali</label>
                                <input type="text" name="nm_wali" class="form-control">
                            </div>
                            <div class="mb-3"id = "fileberkas"></div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sandi</label>
                                <input type="text" name="sandi" class="form-control">
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btn-menambahkan" >Menambahkan</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>

            <?=$this->endSection()?>


            <?=$this->section('script')?>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>

            <script src="//cdn.jsdelivr.net/gh/JeremyFagis/dropify@master/dist/js/dropify.min.js"></script>
            <link href="https://cdn.jsdelivr.net/gh/JeremyFagis/dropify@master/dist/css/dropify.min.css"
            rel="stylesheet" />

            <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
            <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>

  function Fungsidropify(filename =''){
        $('div#fileberkas').html(`<input type="file" name="berkas" data-allowed-file-extensions="png jpg bnp gif"
                                    data-default-file="${filename}">`);
        $('input[name=berkas]').dropify();

    }
    $(document).ready(function(){
        $('select[name=kelas_id]').select2({width:'100%',
            dropdownParent : $('form#formSiswa')
        });
    
    $('form#formSiswa').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-siswa").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

        
     $('button#btn-menambahkan').on('click' , function(){
            $('form#formSiswa').submit();

    });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formSiswa').trigger('reset');
            $('input[name=_method]').val('');
            Fungsidropify('');
    });
        $('table#table-siswa').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pegawai/siswa/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=nisn]').val(e.nisn);
                $('input[name=nis]').val(e.nis);
                $('input[name=status_masuk]').val(e.status_masuk);
                $('input[name=thn_masuk]').val(e.thn_masuk);
                $('input[name=nama_depan]').val(e.nama_depan);
                $('input[name=nama_belakang]').val(e.nama_belakang);
                $('input[name=nik]').val(e.nik);
                $('input[name=no_kk]').val(e.no_kk);
                $('input[name=gender]').val(e.gender);
                $('input[name=tgl_lahir]').val(e.tgl_lahir);
                $('input[name=tempat_lahir]').val(e.tempat_lahir);
                $('input[name=alamat]').val(e.alamat);
                $('input[name=kota]').val(e.kota);
                $('input[name=kelas_id]').val(e.kelas_id);
                $('input[name=no_telp_rumah]').val(e.no_telp_rumah);
                $('input[name=no_hp_ibu]').val(e.no_hp_ibu);
                $('input[name=no_hp_ayah]').val(e.no_hp_ayah);
                $('input[name=nm_ayah]').val(e.nm_ayah);
                $('input[name=nm_ibu]').val(e.nm_ibu);
                $('input[name=nm_wali]').val(e.nm_wali);
                Fungsidropify(e.berkas);
                $('input[name=email]').val(e.email);
                $('input[name=sandi]').val(e.sandi);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
         });

         $('table#table-siswa').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/pegawai/siswa`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-siswa').DataTable().ajax.reload();
                });
                }
          });

        $('table#table-siswa').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pegawai/siswa/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'nisn',},
                {data: 'nis'},
                {data: 'status_masuk',
                    render: (data,type,row,meta)=>{
                        if(data === 'A'){
                            return 'Asal';
                        }
                        else if(data === 'P'){
                            return 'Pindahan';
                        }
                        return data;
                    }
                },
                {data: 'thn_masuk',},
                { data: 'nama_depan', render:(data,type,row,meta)=>{
                    return `${data} ${row['nama_belakang']}`;
                }},
                {data: 'tingkat', render:(data,type,row,meta)=>{
                    return `${data} ${row['kelas']} `;
                }},
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class= 'btn-light' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn-danger'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });

</script>
<?=$this->endSection()?>