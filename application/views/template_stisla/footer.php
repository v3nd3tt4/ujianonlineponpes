      <footer class="main-footer">
      	<div class="footer-left">
      		Copyright &copy; 2024 Sistem Pondok Pesantren. All Rights Reserved.
      	</div>
      	<div class="footer-right">
      		Version 1.0.0
      	</div>
      </footer>
      </div>
      </div>

      <!-- General JS Scripts -->
      <script src="<?= base_url() ?>assets_stisla/jquery.min.js"></script>
      <script src="<?= base_url() ?>assets/popper.min.js"></script>
      <script src="<?= base_url() ?>assets/bootstrap.min.js"></script>
      <script src="<?= base_url() ?>assets/jquery.nicescroll.min.js"></script>
      <script src="<?= base_url() ?>assets/moment.min.js"></script>
      <script src="<?= base_url() ?>assets_stisla/js/stisla.js"></script>

      <script src="<?= base_url() ?>assets_stisla/datatables/datatables.min.js"></script>
      <script src="<?= base_url() ?>assets_stisla/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?= base_url() ?>assets_stisla/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>

      <script src="<?= base_url() ?>assets/dataTables.buttons.min.js"></script>
      <script src="<?= base_url() ?>assets/buttons.flash.min.js"></script>
      <script src="<?= base_url() ?>assets/jszip.min.js"></script>
      <script src="<?= base_url() ?>assets/pdfmake.min.js"></script>
      <script src="<?= base_url() ?>assets/vfs_fonts.js"></script>
      <script src="<?= base_url() ?>assets/buttons.html5.min.js"></script>
      <script src="<?= base_url() ?>assets/buttons.print.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      <script>
      	$(document).ready(function() {
      		$('.dataTables').DataTable();

      		$('.dataTableExport').DataTable({
      			"pagingType": "full_numbers",
      			"aLengthMenu": [10, 25, 50, 75, 100, 150, 200],
      			"ordering": false,
      			bInfo: true,
      			paging: true,
      			dom: 'Bfrtip',
      			buttons: [{
      					extend: 'copy',
      					className: 'btn-success'
      				},
      				{
      					extend: 'csv',
      					className: 'btn-success'
      				},
      				{
      					extend: 'excel',
      					className: 'btn-success',
      					title: '' +
      						'LMS Sys',
      				},
      				{
      					extend: 'pdf',
      					className: 'btn-success',
      					title: '' +
      						'LMS Sys',
      				},
      				{
      					extend: 'print',
      					className: 'btn-success',
      					text: 'Print',
      					header: true,
      					footer: true,
      					title: '<center>' +
      						'LMS Sys' +
      						'</center>',
      				}
      			]
      		});

      		$('.select2').select2();
      	});
      </script>

      <script src="<?= base_url() ?>assets_stisla/js/scripts.js"></script>
      <script src="<?= base_url() ?>assets_stisla/js/custom.js"></script>

      <?php
		if (!empty($script)) {
			$this->load->view($script);
		}
		?>

      </body>

      </html>
