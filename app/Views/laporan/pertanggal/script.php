<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $(document).on('click', '.btn-tambah', function(e) {
            e.preventDefault();
            $('#modal-tambah').modal('show');
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            $('#modal-edit').modal('show');
            var id_jenis_barang = $(this).attr('data-id');
            $('#id_jenis_barang').val(id_jenis_barang);
            var nama_jenis_barang = $(this).attr('data-nama');
            $('#nama_jenis_barang').val(nama_jenis_barang);
        });

        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            $('#modal-hapus').modal('show');
            var id_jenis_barang = $(this).attr('data-id');
            $('#id_jenis_barang_hapus').val(id_jenis_barang);

        });


        $(document).on('submit', '#form-tambah', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $(":submit").attr('disabled', true);
            $('.success_message2').html('Loading....');
            $.ajax({
                url: "<?= base_url() ?>master/jenis_barang/simpan",
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
                url: "<?= base_url() ?>master/jenis_barang/update",
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
                url: "<?= base_url() ?>master/jenis_barang/hapus",
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function te() {
        var element = document.getElementById('contentToPrint');
        var opt = {
            //   margin:       0.5,
            filename: 'Laporan.pdf',
            //   image:        { type: 'pdf', quality: 0.98 },
            html2canvas: {
                scale: 1
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'landscape'
            }
        };

        // New Promise-based usage:
        html2pdf().set(opt).from(element).save();

        // Old monolithic-style usage:
        // html2pdf(element, opt);
    }

    function fnExcelReport(idtable) {
        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById(idtable); // id of table

        for (j = 0; j < tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        } else //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }
</script>