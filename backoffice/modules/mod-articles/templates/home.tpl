<style> .table > tbody > tr > td { vertical-align: middle; }</style>
<div class="row">
	<form name="sel-category" action="" method="post">
		<div class="col-xs-10 col-sm-10 col-md-5 md-taleft xs-tacenter">
			<div class="form-group">
				<select name="categoryId" class="form-control">
					<option value="-1" selected>{c2r-category-filter-select}</option>
					{c2r-filter-options}
				</select>
			</div>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-1 md-taleft xs-taright">
			<button type="submit" class="btn btn-primary" name="filterCategory">Filter</button>
		</div>
	</form>
	<div class="col-xs-12 col-sm-12 col-md-6 md-taright xs-tacenter">
		<a href="{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/add/" class="btn btn-add" role="button">
			<i class="fa fa-plus" aria-hidden="true"></i><div class="sm-block15 xs-block15"></div>{c2r-label-add-category}
		</a>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>{c2r-name}</th>
					<th>{c2r-category}</th>
					<th>{c2r-published}</th>
					<th>{c2r-date}</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{c2r-table-body}
			</tbody>
		</table>
	</div>
</div>
