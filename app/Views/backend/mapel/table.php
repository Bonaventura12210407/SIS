<?=$this->extend('backend/template')?>

<?=$this->section('content')?>



            <div class="container">
            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Mata Pelajaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button class="float-end btn btn-sm btn-dark" id="btn-tambah">Tambah Data</button>
                <table id='table-mapel' class="datatable table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Kelompok</th>
                            <th>Keterangan</th>
                            <th>Tingkat</th>
                            <th>Kkm</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div id="modalForm" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Mata Pelajaran</h4>
                            <button class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form id="formMapel" method="post" action="<?=base_url('mapel') ?>">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="_method" />
                            <div class="mb-3">
                                <label class="form-label">Mapel</label>
                                <input type="text" name="mapel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelompok</label>
                                <select name="kelompok" class="form-control">
                                    <option value="A">Materi Nasional</option>
                                    <option value="B">Materi Lokal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tingkat</label>
                                <input type="text" name="tingkat" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kkm</label>
                                <input type="text" name="kkm" class="form-control">
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
        
        
        $('form#formMapel').submitAjax({
        pre:()=>{
            $('button#btn-menambahkan').hide();
            
        },
        pasca:()=>{
            $('button#btn-menambahkan').show();

        },

        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-mapel").DataTable().ajax.reload();
        },

        error:(xhr, status)=>{
            alert('Maaf data salah');
        }

        });


        $('button#btn-menambahkan').on('click' , function(){
            $('form#formMapel').submit();

        });


        $('button#btn-tambah').on('click' , function(){
            $('#modalForm').modal('show');
            $('form#formMapel').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-mapel').on('click', '.btn-light', function (){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/mapel/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=mapel]').val(e.mapel);
                $('input[name=kelompok]').val(e.kelompok);
                $('input[name=keterangan]').val(e.keterangan);
                $('input[name=tingkat]').val(e.tingkat);
                $('input[name=kkm]').val(e.kkm);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');

            });
        });

        $('table#table-mapel').on('click', '.btn-danger', function (){
            let konfirmasi = confirm ('yakin hapus data?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";


                $.post(`${baseurl}/mapel`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-mapel').DataTable().ajax.reload();
                });
            }
        });


        $('table#table-mapel').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('mapel/all')?>",
                method: 'GET'
            },
            columns:[
                {data: 'id',sortable:false, searchable:false,
                    render: (data,type,row,meta)=>{
                        return meta.settings._iDisplayStart + meta.row + 1;
                    }
                },
                {data: 'mapel',},
                {data: 'kelompok',
                    render: (data,type,row,meta)=>{
                        if(data === 'A'){
                            return 'Materi Nasional';
                        }
                        else if(data === 'B'){
                            return 'Materi lokal';
                        }
                        return data;
                    }
                },
                {data: 'keterangan',},
                {data: 'tingkat',},
                {data: 'kkm',},
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