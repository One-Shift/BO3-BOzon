<form action="{c2r-path-bo}/0/{c2r-lg}/{c2r-module-folder}/edit/{c2r-id}" method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="inputFile">File</label>
				<div class="input-group">
					<input type="text" class="form-control" id="inputFile" placeholder="" value="{c2r-file}" readonly>
					<a class="input-group-addon" href="{c2r-path}/u-files/{c2r-file}" target="_blank">
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
				</div>
			</div>
			<div class="form-group">
				<label for="inputType">Type</label>
				<input type="text" class="form-control" id="inputType" placeholder="" value="{c2r-type}" readonly>
			</div>
			<div class="form-group">
				<label for="inputModule">Module</label>
				<select class="form-control">
					<option>Select one module</option>
					{c2r-modules-list}
				</select>
			</div>
			<div class="form-group">
				<label for="inputIdAss">ID Ass</label>
				<input type="number" class="form-control" id="inputIdAss" placeholder="" value="{c2r-id-ass}" name="inputIdAss">
			</div>

		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="inputDescription">Description</label>
				<input type="text" class="form-control" id="inputDescription" placeholder="" value="{c2r-description}" name="inputDescription">
			</div>
			<div class="form-group">
				<label for="inputCode">Code</label>
				<textarea class="form-control" name="inputCode" rows="3">{c2r-code}</textarea>
			</div>
			<div class="form-group">
				<label for="inputSort">Sort</label>
				<input type="number" class="form-control" id="inputSort" placeholder="" value="{c2r-sort}" name="inputSort">
			</div>
			<div class="form-group">
				<label for="inputDate">Date</label>
				<input type="text" class="form-control" id="inputDate" placeholder="YYYY-mm-dd HH:ii:ss" value="{c2r-date}" name="inputDate">
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-save pull-right" name="submit">Save</button>
</form>
