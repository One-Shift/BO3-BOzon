<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>BO3/BOzon3 Installation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" charset="utf-8"></script>
		<style media="screen">
			textarea {
				width: 100%;
				font-family: monoco, courier, monospace;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Database Structure</h1>
					<label for="">SQL Script</label>
					<textarea rows="20" readonly><?= file_get_contents("base.sql"); ?></textarea>

					<h1>Database 1st user</h1>
					<p>
						<label for="">User:</label><br>
						<input type="text" name="" value="demo@demo.demo" readonly="" class="form-control">
					</p>
					<p>
						<label for="">Password:</label><br>
						<input type="text" name="" value="demo" readonly="" class="form-control">
					</p>
					<label for="">SQL Script</label>
					<textarea rows="8" readonly><?= file_get_contents("add-demo-user.sql"); ?></textarea>
					<p><br></p>
					<p><label>Recomended:</label><br>Replace <code>`os_</code> for your own prefix, eg.: <code>`prefix_</code></p>
					<p><br></p>
					<p align="center" class="bg-danger text-danger" style="padding: 15px;">Please, delete install folder after full configuration.</p>
					<p><br></p>
				</div>
			</div>
		</div>
	</body>
</html>
