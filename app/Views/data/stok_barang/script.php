<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $(document).on('keyup', '.modal1', function(e) {
            e.preventDefault();
            var modal = $(this).val();
            var jumlah = $('.jumlah1').val();
            var modal_total = modal * jumlah;
            $('.modal_total').val(modal_total);
        });

        $(document).on('keyup', '.modal2', function(e) {
            e.preventDefault();
            var modal = $(this).val();
            var jumlah = $('.jumlah').val();
            var modal_total = modal * jumlah;
            $('.modal_total2').val(modal_total);
        });

        $(document).on('click', '.btn-tambah', function(e) {
            e.preventDefault();
            $('#modal-tambah').modal('show');
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            $('#modal-edit').modal('show');
            var id_stok_barang = $(this).attr('data-id');
            $('#id_stok_barang').val(id_stok_barang);
            $.ajax({
                url: "<?= base_url() ?>data/stok_barang/getdata",
                method: "POST",
                data: {
                    id_stok_barang: id_stok_barang
                },
                dataType: 'json',
                success: function(data) {
                    $('#tanggal_masuk').val(data.tanggal_masuk);
                    $('#tanggal_produksi').val(data.tanggal_produksi);
                    $('#tanggal_expired').val(data.tanggal_expired);
                    $('#jumlah').val(data.jumlah);
                    $('#modal1').val(data.modal);
                    $('#modal_total').val(data.modal_total);
                }
            });
        });

        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            $('#modal-hapus').modal('show');
            var id_stok_barang = $(this).attr('data-id');
            $('#id_stok_barang_hapus').val(id_stok_barang);

        });


        $(document).on('submit', '#form-tambah', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>data/stok_barang/simpan",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'sukses') {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                        location.reload();
                    } else {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                    }
                }
            });
        });

        $(document).on('submit', '#form-edit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>data/stok_barang/update",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'sukses') {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                        location.reload();
                    } else {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                    }
                }
            });
        });

        $(document).on('submit', '#form-hapus', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>data/stok_barang/hapus",
                method: "POST",
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'sukses') {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                        location.reload();
                    } else {
                        $(":submit").attr('disabled', false);
                        $('.success_message2').html(data.msg);
                    }
                }
            });
        });
    });
</script>