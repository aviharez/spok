<div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form method="POST" action="{{ route('update_order') }}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Edit Order</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                                <label>Peminta</label>
                                <div class="form-group">
                                    <input type="hidden" name="id_update" id="id_update"/>
                                    <input type="text" class="form-control" name="peminta" id="peminta_update" disabled>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                                <label>Tanggal Permintaan</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="tanggal" id="tanggal_update" disabled>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>Kode & Nomor Mesin</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kd_mesin" id="kd_mesin_update">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label>Prioritas</label>
                            <div class="form-group">
                                <select id="prioritas_update" name="prioritas" class="select2 form-control">
                                    <option value="none" selected="" disabled="">-- Prioritas --</option>
                                    <option value="E">E   (Urgent, harus segera dikerjakan. Diluar jam kerja reguler call out)</option>
                                    <option value="1">1   (Pekerjaan harus sudah selesai max 3 hari setelah POK disetujui)</option>
                                    <option value="2">2   (Pekerjaan harus selesai max 7 hari setelah POK disetujui)</option>
                                    <option value="3">3   (Pekerjaan harus sudah selesai max 1 bulan setelah POK disetujui)</option>
                                </select>
                            </div>
                        </div>
                    </div>      
                    <label>Deskripsi</label>
                    <div class="form-group">
                        <textarea rows="5" class="form-control" id="description_update" name="description">
                            
                        </textarea>
                    </div>
                    <label>Eksekutor</label>
                    <div class="form-group">
                        <select id="eksekutor_update" name="eksekutor" class="select2 form-control">
                            <option value="none" selected="" disabled="">-- Eksekutor --</option>
                            @foreach ($executor as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>Penghentian Operasi Pabrik</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pop" id="pop_update" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label>Ketentuan Lainnya</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ketentuan" id="ketentuan_update" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>Status</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="status" id="status_update" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label>Tanggal Approve</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="approved_at" id="approved_at_update" disabled>
                            </div>
                        </div>
                    </div>  
                    
                    
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <label>Tanggal Konfirmasi</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="confirmed_at" id="confirmed_at_update" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label>Dikonfirmasi Oleh</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="confirmed_by" id="confirmed_by_update" disabled>
                            </div>
                        </div>
                    </div>  
                    
                    
                    <label>Tanggal Penyelesaian</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="finished_at" id="finished_at_update" disabled>
                    </div>
                    <label>Keterangan</label>
                    <div class="form-group">
                        <textarea rows="5" class="form-control" id="keterangan_update" name="keterangan" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>