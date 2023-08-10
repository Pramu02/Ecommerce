<?php
include 'includes/header.php';

?>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>


<style>
	iframe {
		display: block;
		margin: auto;
	}

	td img {
		width: 65px;
		height: 80px;
		margin: auto;
	}

	#new_product {
		margin-top: 10px;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-block btn-sm btn-primary col-sm-2" type="button" id="new_product"><i
					class="fa fa-plus"></i> New Product</button>
		</div>
	</div>
	<div class="row">
		<div class="card col-md-12 mt-3">
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Product Image</th>
							<th class="text-center">Name</th>
							<th class="text-center">Price</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$prod = $conn->query("SELECT * FROM product ");
						while ($row = $prod->fetch_assoc()) {
							?>
							<tr>
								<td>
									<?php echo $i++ ?>
								</td>
								<td>
									<center><img src="<?php echo $row['Image'] ?>" alt=""></center>
								</td>
								<td>
									<?php echo ucwords($row['Name']) ?>
								</td>
								<td>
									<?php echo ucwords($row['Price']) ?>
								</td>
								<td>
									<center>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Action</button>
											<button type="button" class="btn btn-primary dropdown-toggle "
												data-bs-toggle="dropdown" aria-expanded="false">
												<span class="visually-hidden">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item edit_product" href="#"
														data-id='<?php echo $row['PID'] ?>'>Edit</a></li>
												<li>
													<hr class="dropdown-divider">
												</li>
												<li><a class="dropdown-item delete_product" href="#"
														data-id='<?php echo $row['PID'] ?>'>Delete</a></li>
											</ul>
										</div>
									</center>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="confirm_modal" role='dialog'>
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmation</h5>
			</div>
			<div class="modal-body">
				<div id="delete_content"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

</body>

<script>
	function uni_modal(title, url) {
		// Example code for creating a simple modal using Bootstrap
		var modal = $('<div class="modal">');
		modal.html('<div class="modal-dialog">' +
			'<div class="modal-content">' +
			'<div class="modal-header">' +
			'<h5 class="modal-title">' + title + '</h5>' +
			'<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
			'<span aria-hidden="true">&times;</span>' +
			'</button>' +
			'</div>' +
			'<div class="modal-body">' +
			'<iframe src="' + url + '" width="450px" height="600px"></iframe>' +
			'</div>' +
			'</div>' +
			'</div>');

		modal.modal('show');
	}

	$(document).ready(function () {
		$('#new_product').click(function () {
			uni_modal('New Product', 'add_product.php');
		})
		$('.edit_product').click(function () {
			uni_modal('Edit Product', 'edit_product.php?id=' + $(this).attr('data-id'));
		})
		$('.delete_product').click(function () {
			_conf('Are you sure to delete this data?', 'delete_product', [$(this).attr('data-id')]);
		})

		function delete_product($id = '') {
			start_load();
			$.ajax({
				url: 'ajax.php?action=delete_product',
				method: 'POST',
				data: { id: $id },
				success: function (resp) {
					if (resp == 1) {
						alert_toast("Data successfully deleted", 'success');
						setTimeout(function () {
							location.reload();
						}, 1500);
					}
				}
			});
		}
	});

	window.start_load = function () {
		$('body').prepend('<div id="preloader2"></div>');
	}
	window.end_load = function () {
		$('#preloader2').fadeOut('fast', function () {
			$(this).remove();
		});
	}
	window._conf = function ($msg = '', $func = '', $params = []) {
		$('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
		$('#confirm_modal .modal-body').html($msg);
		$('#confirm_modal').modal('show');
	}
</script>