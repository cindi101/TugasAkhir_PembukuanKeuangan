<script src="<?= base_url() ?>assets/jquery.js"></script>
<link href="<?= base_url() ?>assets/select2.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/select2.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumInputLength: 3,
            allowClear: true,
            placeholder: 'Masukan kode barang atau nama barang',
            ajax: {
                type: "POST",
                dataType: 'json',
                url: '<?= base_url() ?>transaksi/penjualan/getbarang',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                },
            }
        }).on('select2:select', function(evt) {
            var data = $(".select2 option:selected").text();
            // alert("Data yang dipilih adalah " + data);
            console.log(data);
        });

        $(document).on('submit', '#form-tambah', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            // $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>transaksi/penjualan/simpan",
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

        $(document).on('keyup', '#uang', function(e) {
            e.preventDefault();
            var uang = $(this).val();
            var total_harga_untuk_bayar = $('#total_harga_untuk_bayar').val();

            var kembalian = uang - total_harga_untuk_bayar;
            $('#kembalian').html('Rp. ' + kembalian);
            $('#kembalianval').val(kembalian);
        });

        $(document).on('blur', '#uang', function() {
    var uang = $(this).val();
    var total_harga_untuk_bayar = $('#total_harga_untuk_bayar').val();

    if (parseInt(total_harga_untuk_bayar) > parseInt(uang)) {
        alert('Uang yang dimasukkan kurang dari total harga untuk bayar.');
        
    }
});

        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            $('#modal-hapus').modal('show');
            var id_detail_transaksi = $(this).attr('data-id');
            $('#id_detail_transaksi_hapus').val(id_detail_transaksi);


        });

        $(document).on('submit', '#form-hapus', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>transaksi/penjualan/hapus",
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

        $(document).on('submit', '#form-checkout', function(e) {
    e.preventDefault();
    var uang_yang_bayar = $('#uang').val();
    var jumlah_harus_bayar = $('#total_harga_untuk_bayar').val();

    if (parseInt(uang_yang_bayar) < parseInt(jumlah_harus_bayar)) {
        alert('Uang yang dimasukkan kurang dari total harga untuk bayar.');
        return false; // Mencegah pengiriman formulir jika uang kurang
    }

    var data = $(this).serialize();
    $(":submit").attr('disabled', true);
    $('.success_message2').html('Loading....');
    $.ajax({
        url: "<?= base_url() ?>transaksi/penjualan/checkout",
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

        $(document).on('click', '.btn-checkout', function(e) {
            e.preventDefault();
            $('#modal-checkout').modal('show');

            var uang_yang_bayar = $('#uang').val();
            var kembalian = $('#kembalianval').val();
            var jumlah_harus_bayar = $('#total_harga_untuk_bayar').val();

            $('#jumlah_harus_bayar2').val(jumlah_harus_bayar);
            $('#uang_yang_bayar2').val(uang_yang_bayar);
            $('#kembalian2').val(kembalian);

        });

    });
</script>