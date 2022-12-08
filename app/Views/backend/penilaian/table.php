<?=$this->extend('backend/template')?>

<?=$this->section('content')?>



            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Penilaian Siswa</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
                
                <table id='table-penilaian' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Siswa</th>
                            <th>Total Nilai</th>
                            <th>Deskripsi Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Penilaian</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formPenilaian" method="post" action="<?=base_url('penilaian') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Mapel</label>
                                <select name="mapel_id" class="form-control">
                                <?php
                                        use App\Models\MapelModel;


                                        $r = (new MapelModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['mapel']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Siswa</label>
                                <select name="siswa_id" class="form-control">
                                <?php
                                        use App\Models\SiswaModel;


                                        $r = (new SiswaModel())->findAll();
                                        
                                        foreach($r as $k){
                                            echo "<option value='{$k['id']}'>{$k['nama_depan']}
                                            - {$k['nis']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Nilai</label>
                                <input type="text" name="total_nilai" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Nilai</label>
                                <input type="text" name="deskripsi_nilai" class="form-control">
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
        $('select[name=mapel_id]').select2({width:'100%',
            dropdownParent : $('form#formPenilaian')
        });
        $('select[name=siswa_id]').select2({width:'100%',
            dropdownParent : $('form#formPenilaian')
        });
    
    $('form#formPenilaian').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-penilaian").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });

        
     $('button#btn-menambahkan').on('click' , function(){
            $('form#formPenilaian').submit();

    });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formPenilaian').trigger('reset');
            $('input[name=_method]').val('');
    });
        $('table#table-penilaian').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/penilaian/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=mapel_id]').val(e.mapel_id);
                $('input[name=siswa_id]').val(e.siswa_id);
                $('input[name=total_nilai]').val(e.total_nilai);
                $('input[name=deskripsi_nilai]').val(e.deskripsi_nilai);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
         });

         $('table#table-penilaian').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/penilaian`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-penilaian').DataTable().ajax.reload();
                });
                }
          });

        $('table#table-penilaian').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('penilaian/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                { data: 'mapel', render:(data,type,row,meta)=>{
                    return `${data} `;
                }},
                {data: 'siswa', render:(data,type,row,meta)=>{
                    return `${data} - ${row['nis']}`;
                }},
                {data: 'total_nilai',},
                {data: 'deskripsi_nilai',},
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
