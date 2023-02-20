@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'referentiels.store']) !!}

		<div class="mb-3">
			{{ Form::label('libelle', 'Libelle', ['class'=>'form-label']) }}
			{{ Form::text('libelle', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('validated', 'Validation', ['class' => 'form-label']) }}
			<div class="ml-4">
				<label class="form-check-label mr-3">
					{{ Form::radio('validated', 1, false, ['class' => 'form-check-input']) }}
					Validé
				</label>
				<label class="form-check-label">
					{{ Form::radio('validated', 0, true, ['class' => 'form-check-input']) }}
					Non validé
				</label>
			</div>
		</div>
		<div class="mb-3">
			{{ Form::label('horaire', 'Horaire', ['class'=>'form-label']) }}
			{{ Form::number('horaire', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('type', 'Type', ['class'=>'form-label']) }}
			{{ Form::select('type_id', $types, null, array('class' => 'form-control')) }}
		</div>



		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop