@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Consulta</div>
				<div class="panel-body">

					<form class="form-horizontal" role="form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">CNPJ</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="cnpj" id="cnpj">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" id="submit" onclick="ajax()" class="btn btn-primary">Consultar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2" id="ajaxResponse">
		</div>
	</div>
</div>


<script>
	function ajax (){
	        var cnpj = $('#cnpj').val();
	        var published_at = $('#published_at').val();
	        $.ajax({
	            type: "GET",
	            url: '/teste-uplexis/public/index.php/api/sintegra/es/'+cnpj,
			    xhrFields: {
			        withCredentials: true
			    },
	            beforeSend: function (xhr) {
			        xhr.setRequestHeader('Authorization', 'Basic ' + btoa('{{$usuario}}:{{$senha}}'));
			    },
	            success: function( msg ) {
           		  $("#ajaxResponse").html("");
	            	if(!jQuery.isEmptyObject(msg)){
	            		var obj = JSON.parse(msg);

		                jQuery.each(obj, function(key, val) {
		                	//console.log(key + ':' +val);
		                	 var item = $("<div class='row'></div>");
		                	 var property = $("<div class='col-md-12'>\n"+
												"<div class='row'>\n"+
													"<div class='col-md-6'>\n"+
													key+"\n"+
													"</div>\n"+
													"<div class='col-md-6'>\n"+
													val.trim()+"\n"+
													"</div>\n"+
												"</div>\n"+
											"</div>");
		                	 item.append(property);
						  $("#ajaxResponse").append(item);
						});

	            	} else{
	            		$("#ajaxResponse").html("Empresa não encontrada");
	            	}
	            }
	        });
	    };
</script>
@endsection