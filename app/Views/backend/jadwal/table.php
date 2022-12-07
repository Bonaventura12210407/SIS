<?=$this->extend('backend/templatesiswa')?>

<?=$this->section('content')?>





            <div class="container">
               
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Jadwal</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <table id='table-jadwal' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Pegawai</th>
            
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Jadwal</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formJadwal" method="post" action="<?=base_url('jadwal') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Hari</label>
                                <input type="text" name="hari" class="form-control">
                            </div>
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
                                <label class="form-label">Mapel</label>
                                <select name="mapel_id" class="form-control">
                                    <?php
                                        use App\Models\MapelModel;


                                        $r = (new MapelModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['mapel']} - {$k['kelompok']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="text" name="jam_mulai" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jam Selesai</label>
                                <input type="text" name="jam_selesai" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pegawai</label>
                                <select name="pegawai_id" class="form-control">
                                    <?php
                                        use App\Models\PegawaiModel;


                                        $r = (new PegawaiModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_depan']} {$k['nama_belakang']} </option>";
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
            dropdownParent : $('form#formJadwal')
        });
        
        $('select[name=mapel_id]').select2({width:'100%',
            dropdownParent : $('form#formJadwal')
        });
        
        $('select[name=pegawai_id]').select2({width:'100%',
            dropdownParent : $('form#formJadwal')
        });
    
    $('form#formJadwal').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-jadwal").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

        
     $('button#btn-menambahkan').on('click' , function(){
            $('form#formJadwal').submit();

    });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formJadwal').trigger('reset');
            $('input[name=_method]').val('');
    });
        $('table#table-jadwal').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/jadwal/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=hari]').val(e.hari);
                $('input[name=kelas_id]').val(e.kelas_id);
                $('input[name=mapel_id]').val(e.mapel_id);
                $('input[name=jam_mulai]').val(e.jam_mulai);
                $('input[name=jam_selesai]').val(e.jam_selesai);
                $('input[name=pegawai_id').val(e.pegawai_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
         });

         $('table#table-jadwal').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/jadwal`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-jadwal').DataTable().ajax.reload();
                });
                }
          });

        $('table#table-jadwal').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('jadwal/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'hari', render:(data,type,row,meta)=>{
                    let map = {'1' : 'Minggu', '2': 'Senin', '3':'Selasa', '4':'Rabu', '5':'Kamis', '6':'Jumat', '7':'Sabtu'};
                    return `${map[row['hari']] ?? ''}`;
                }},
                {data: 'tingkat', render:(data,type,row,meta)=>{
                    return `${data} ${row['kelas']}`;
                }},
                {data: 'mapel', render:(data,type,row,meta)=>{
                    return `${data}`;
                }},
                {data: 'jam_mulai',},
                {data: 'jam_selesai',},
                {data: 'nama_depan', render:(data,type,row,meta)=>{
                    return `${data}  ${row['pegawai']} `;
                }},
                
            ]
        });
    });

</script>
<?=$this->endSection()?>