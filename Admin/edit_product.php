<?php
include 'includes/header.php';
if (isset($_GET['id'])) {
	$mov = $conn->query("SELECT * FROM product where PID =" . $_GET['id']);
	foreach ($mov->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>

<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-product">
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<label for="" class="control-label">Product Name</label>
				<input type="text" name="Name" required="" class="form-control"
					value="<?php echo isset($meta['Name']) ? $meta['Name'] : '' ?>">
			</div>

			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<label for="" class="control-label">Product Price</label>
				<input type="text" name="Price" required="" class="form-control"
					value="<?php echo isset($meta['Price']) ? $meta['Price'] : '' ?>">
			</div>

			<div class="form-group">
				<img src="<?php echo isset($meta['Image']) ? $meta['Image'] : '' ?>" alt="" id="Image" width="80"
					height="100">
			</div>

			<div class="form-group input-group">
				<label for="" class="control-label">Product Image</label>
				<br>

				<div class="custom-file">
					<input type="file" name="Image" class="custom-file-input" id="Image"
						onchange="displayImg(this,$(this))">
					<label class="custom-file-label" for="Image">Choose file</label>
				</div>

				<div class="input-group-prepend">
					<span class="input-group-text">Upload</span>
				</div>
			</div>

			<div class="form-group">
				<button class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
</div>

<script>
	$('#manage-product').submit(function (e) {
		e.preventDefault();
		start_load();
		$.ajax({
			url: 'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			error: err => {
				console.log(err);
			},
			success: function (resp) {
				if (resp == 1) {
					alert_toast('Data successfully saved.', 'success');
				}
			}
		});
	});

	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#Image').attr('src', e.target.result);
				_this.siblings('label').html(input.files[0]['name']);
				_this.siblings('input[name="fname"]').val('<?php echo strtotime(date('y-m-d H:i:s')) ?>_' + input.files[0]['name']);
				var p = $('<p></p>');
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>