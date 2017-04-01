@extends('base')

@section('main')

<div class="container">
  <div class="upload-form-wrapper row">

    <div class="row-sm-12">

      {!! Form::open(array('route'=>'Produtos.store','method'=>'POST', 'files'=>true, 'id'=>'formProduto')) !!}
        <div class="form-group">
          <label for="uploadProduct">Selecione um arquivo para importar:</label>
          {!! Form::file('uploadProduct', array('class'=>'upload-button')) !!}
          <p class="help-block">Formatos aceitos: Arquivos de planilha Excel (.xls, .xlsx)</p>
        </div>

        <div class="progress hidden">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
            Enviando...
          </div>
        </div>

        <div class="btn-submit row-sm-6">
          {!! Form::submit('Enviar', array('class'=>'btn btn-primary btn-form-file-submit hidden', 'disabled'=>'disabled')) !!}
          <a href="{{ route('Produtos.index') }}">Voltar para a lista</a>
        </div>

      {!! Form::close() !!}

    </div>

  </div>
</div>

<script type='text/javascript' src="{{ asset('js/uploadFile.js') }}"></script>

@stop
