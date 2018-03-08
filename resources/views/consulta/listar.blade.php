@extends('app')

@section('content')
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
					<div class="col-md-5">
				    	<p>Usuário: {{ $consulta->id_usuario }}</p>
				    </div>
					<div class="col-md-5">
					    <p>CNPJ: {{ $consulta->cnpj }}</p>
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
</div>

@endsection