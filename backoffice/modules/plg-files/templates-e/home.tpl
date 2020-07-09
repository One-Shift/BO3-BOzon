<div class="alert alert-warning {c2r-permissions-display}" role="alert">
	<i class="fas fa-exclamation-triangle"></i> {c2r-lg-permissions}
</div>
<div class="card">
	<div class="card-header">
		<strong>{c2r-lg-files-upload}</strong>
		<!-- <small>Use this class
			<code>.btn-block</code>
		</small> -->
	</div>
	<div class="card-body">
		<form id="upload" action="{c2r-bo-path}/{c2r-lg}/4-files/api/?r=upload" method="POST" enctype="multipart/form-data" data-id="{c2r-id}" data-module="{c2r-module}">
			<input id="fileselect" name ="fileselect[]" type="file" multiple="multiple"/>
			<div id="filedrag">{c2r-lg-drop}</div>
			<div id="submitbutton">
				<button type="submit">{c2r-lg-files-submit}</button>
			</div>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<strong>{c2r-lg-uploaded-files}</strong>
	</div>
	<div class="card-body">
		<div id="uploaded-list"></div>
	</div>
</div>

<style media="screen">
	#filedrag {
		display: none;
		font-weight: bold;
		text-align: center;
		padding: 60px 0;
		margin: 15px 0;
		color: #555;
		border: 1px dashed #CCC;
		cursor: default;
	}

	#filedrag.hover {
		color: #fff;
		border-color: transparent;
		border-style: solid;
		background: linear-gradient(141deg, #00ccff 0%, #1dcab5 51%, #37c871 75%);
	}
</style>
<script type="text/javascript">
	var data;

	var uploaded_tpl = '{c2r-uploaded-item-tpl}';
	var message_tpl = '{c2r-message-tpl}';
	/* getElementById */
	function $id(id) {
		return document.getElementById(id);
	}

	/* call initialization file */
	if (window.File && window.FileList && window.FileReader) { Init(); }

	/* initialize */
	function Init() {
		var fileselect = $id("fileselect"),
			filedrag = $id("filedrag"),
			submitbutton = $id("submitbutton");

		/* file select */
		fileselect.addEventListener("change", FileSelectHandler, false);

		/* is XHR2 available? */
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			/* file drop */
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";

			/* remove submit button */
			submitbutton.style.display = "none";
		}
	}

	/* file drag hover */
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}

	/* file selection */
	function FileSelectHandler(e) {
		/* cancel event and hover styling */
		FileDragHover(e);

		/* fetch FileList object */
		var files = e.target.files || e.dataTransfer.files;
		/* process all File objects */
		for (var i = 0, f; f = files[i]; i++) {
			UploadFile(f);
		}
	}

	function UploadFile(file) {
		var xhr = new XMLHttpRequest();

		if (xhr.upload) {
			xhr.upload.onprogress = function(e) {
				var done = e.position || e.loaded, total = e.totalSize || e.total;
				/* console.log('xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%'); */
			};
		}

		xhr.onreadystatechange = function(e) {
			if (4 == this.readyState) {
				/* console.log(['xhr upload complete', e]); */
			}
		};

		xhr.open("POST", $("#upload").attr("action"), true);
		var formData = new FormData();
		formData.append("id", $("#upload").data("id"));
		formData.append("module", $("#upload").data("module"));
		formData.append("file", file);

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				data = readBody(xhr);
				/* console.log(data); */

				fallback (data.object);
				addItemToList ($.parseJSON(data.object));
			}
		};

		xhr.send(formData);
	}

	function readBody(xhr) {
		var data;
		if (!xhr.responseType || xhr.responseType === "text") {
			data = xhr.responseText;
		} else if (xhr.responseType === "document") {
			data = xhr.responseXML;
		} else {
			data = xhr.response;
		}

		return $.parseJSON(data);
	}

	function fallback (object) {
		if ($("#files-fallback").length > 0) {
			object = $.parseJSON(object);

			$("#files-fallback").val(
				$("#files-fallback").val() + object.id + ","
			)
		}
	}

	function addItemToList (o) {
		$("#uploaded-list").append(uploaded_tpl);

		var line = $("#uploaded-list .row:last-child")[0];
		$(line).find(".file").attr("href", path + "/uploads/" + o.file).html(o.file);
		$(line).find("#inputDescription").val(o.description);
		$(line).find("#inputCode").val(o.code);
		$(line).find("#inputSort").val(o.sort);
		$(line).find(".upload-update").attr("data-id", o.id);
		$(line).find(".upload-delete").attr("data-id", o.id);
	}

	function getList () {
		var id = $("#upload").data("id");
		if (id == "") {
			id = 0;
		}

		$("#uploaded-list").empty();
		$.get("{c2r-bo-path}/{c2r-lg}/4-files/api/" + id + "?r=getList&module={c2r-module}", function (data) {
			data = $.parseJSON(data);
			var o = data.object;
			if (o != false) {
				for (i = 0; i < o.length; i++) {
					addItemToList(o[i]);
				}
			} else {
				$("#uploaded-list").append(message_tpl);
			}
		});
	}

	$(document).ready(function () {
		getList();

		$("body").on("click", ".upload-update", function () {
			var button = $(this);
			var obj = $(this).parent("div").parent("div");

			var form = {};
			form.description = $(obj).find(".inputDescription").val();
			form.code = $(obj).find(".inputCode").val();
			form.sort = $(obj).find(".inputSort").val();

			$.post( "{c2r-bo-path}/{c2r-lg}/4-files/api/" + $(this).attr("data-id") + "?r=update", form, function(data) {
				data = $.parseJSON(data);
				if (data.status) {
					$(button).append(' <i class="fa fa-check-square" aria-hidden="true"></i>');

					setTimeout(function () {$(button).children("i").remove()}, 2500);
				}
			});
		});

		$("body").on("click", ".upload-delete", function () {
			var button = $(this);
			var obj = $(this).parent("div").parent("div");

			$.get( "{c2r-bo-path}/{c2r-lg}/4-files/api/" + $(this).attr("data-id") + "?r=delete", function(data) {
				data = $.parseJSON(data);
				if (data.status) {
					$(obj).remove();
				}
			});
		});
	});
</script>
