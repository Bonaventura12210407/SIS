<?=$this->extend('backend/template')?>

<?=$this->section('content')?>


    <div class="container">
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Kehadiran Guru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>

            <table id='table-kgr' class="datatable table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Pertemuan</th>
                <th>Pegawai</th>
                <th>Jadwal</th>
                <th>Berita Acara</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
    </div>

    <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Kehadiran Guru</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formKgr" method="post" action="<?=base_url('kehadiranguru') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Waktu Masuk</label>
                                <input type="text" name="waktu_masuk" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu Keluar</label>
                                <input type="text" name="waktu_keluar" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pertemuan</label>
                                <input type="text" name="pertemuan" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pegawai</label>
                                <select name="pegawai_id" class="form-control">
                                    <?php
                                        use App\Models\PegawaiModel;


                                        $r = (new PegawaiModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nip']} -  {$k['nama_depan']} - {$k['nama_belakang']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jadwal</label>
                                <select name="jadwal_id" class="form-control">
                                <?php
                                        use App\Models\JadwalModel;


                                        $r = (new JadwalModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['hari']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Berita Acara</label>
                                <input type="text" name="berita_acara" class="form-control">
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

        $('select[name=pegawai_id]').select2({width:'100%',
            dropdownParent : $('form#formKgr')
        });
        $('select[name=jadwal_id]').select2({width:'100%',
            dropdownParent : $('form#formKgr')
        });
        
    $('form#formKgr').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-kgr").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

        $('button#btn-menambahkan').on('click' , function(){
            $('form#formKgr').submit();

    });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formKgr').trigger('reset');
            $('input[name=_method]').val('');
    });

        $('table#table-kgr').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/kehadiranguru/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=waktu_masuk]').val(e.waktu_masuk);
                $('input[name=waktu_keluar]').val(e.waktu_keluar);
                $('input[name=pertemuan]').val(e.pertemuan);
                $('input[name=pegawai_id]').val(e.pegawai_id);
                $('input[name=jadwal_id]').val(e.jadwal_id);
                $('input[name=berita_acara').val(e.berita_acara);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
         });

            $('table#table-kgr').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/kehadiranguru`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-kgr').DataTable().ajax.reload();
                });
                }
          });


        $('table#table-kgr').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('kehadiranguru/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'waktu_masuk',},
                {data: 'waktu_keluar'},
                {data: 'pertemuan',},
                {data: 'nama_depan', render:(data,type,row,meta)=>{
                    return `${data} ${row['nama_belakang']}`;
                }},
                {data: 'jadwal_id', render:(data,type,row,meta)=>{
                    let map = {'1' : 'Minggu', '2': 'Senin', '3':'Selasa', '4':'Rabu', '5':'Kamis', '6':'Jumat', '7':'Sabtu'};
                    return `${map[row['hari']] ?? ''}`;
                }},
                {data: 'berita_acara',},
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
