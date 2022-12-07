<?=$this->extend('backend/template')?>

<?=$this->section('content')?>





            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Kelas Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
                <table id='table-kelassiswa' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Riwayat Studi Kelas Siswa</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formKelassiswa" method="post" action="<?=base_url('pegawai/kelassiswa') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                           
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
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
                                <label class="form-label">Nama Siswa</label>
                                <select name="siswa_id" class="form-control">
                                <?php
                                        use App\Models\SiswaModel;


                                        $r = (new SiswaModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_depan']} - 
                                            {$k['nis']} - {$k['gender']}</option>";
                                        }
                                    ?>
                                </select>
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
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> 
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=kelas_id]').select2({width:'100%',
            dropdownParent : $('form#formKelassiswa')
        });
        $('select[name=siswa_id]').select2({width:'100%',
            dropdownParent : $('form#formKelassiswa')
        });
        
        
        
        $('form#formKelassiswa').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-kelassiswa").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formKelassiswa').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formKelassiswa').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-kelassiswa').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pegawai/kelassiswa/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=kelas_id]').val(e.kelas_id);
                $('input[name=siswa_id]').val(e.siswa_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-kelassiswa').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/pegawai/kelassiswa`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-kelassiswa').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-kelassiswa').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pegawai/kelassiswa/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                { data: 'tingkat', render:(data,type,row,meta)=>{
                    return `${data} ${row['kelas']}`;
                }},
                {data: 'nama_depan', render:(data,type,row,meta)=>{
                    return `${data} - ${row['nis']} - ${row['gender']}`;
                }},
                {data: 'id',
                    render: (data,type,meta,row)=>{
                        var btnEdit     = `<button class='btn btn-light' data-id='${data}'> Edit</button>`;
                        var btnHapus    = `<button class = 'btn btn-danger 'data-id='${data}'> Hapus </button>`;
                        return btnEdit + btnHapus;
                    }

                },
            ]
        });
    });

</script>

<?=$this->endSection()?>