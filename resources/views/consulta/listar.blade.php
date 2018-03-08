@extends('app')

@section('content')
<script>
	var objs = [];
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					Consultas
				</div>
			</div>
			@if (count($consultas) > 0)
				@foreach ($consultas as $consulta)
				<div class="row">
					<div class="col-md-4">
				    	<p>Usuário: {{ $consulta->id_usuario }}</p>
				    </div>
					<div class="col-md-4">
					    <p>CNPJ: {{ $consulta->cnpj }}</p>
					</div>
					<div class="col-md-2">
					    <input type="button" onclick="exibe({{ $consulta->id }})" value="Exibir">
					    <script>
					    	objs[{{ $consulta->id }}] = JSON.parse('<?php echo $consulta->json?>');
					    </script>
					</div>
					<div class="col-md-2">
					    <a href="{{ url('/excluir') }}/{{ $consulta->id }}">Excluir</a>
					</div>
				</div>
				@endforeach
			@else
				<div class="row">
					<div class="col-md-12">
				    	<p>Nenhuma consulta foi realizada.</p>
				    </div>
				</div>
			@endif
		</div>
	</div>


	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Empresa
				</div>
				<div class="col-md-8 col-md-offset-2" id="ajaxResponse">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
		function exibe(id){
         	$("#ajaxResponse").html("");

			jQuery.each(objs[id], function(key, val) {
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
		}
		location.href = "#ajaxResponse";
</script>
@endsection