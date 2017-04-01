@extends('base')

@section('main')
<input type="hidden" name="_token" value=" {{ csrf_token() }}"/>

<div class="container-fluid">

  <h1>Lista de produtos:</h1>
  @if(count($lista) >0)
    <div class="row-sm-12 table-responsive">
      <table class="table table-hover table-striped">
        <thead>
          <th>Lm</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Categoria</th>
          <th>Frete Grátis</th>
          <th>Data de adição</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($lista as $produto)
            <tr>
              <td>{{ $produto->lm }}</td>
              <td>{{ $produto->name }}</td>
              <td>{{ $produto->description }}</td>
              <td>R${{ number_format($produto->price,2,',','.') }}</td>
              <td>{{ $produto->category }}</td>
              <td>{{ $produto->free_shipping ? 'Sim' : 'Não' }}</td>
              <td>{{ $produto->created_at }}</td>
              <td><button type="button" data-id="{{ $produto->lm }}" class="btn btn-danger delete-btn" href="#">Deletar</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row-sm-12">
        <div class="pagination-links">
          {{ $lista->links() }}
        </div>
      </div>
    </div>
  @else
    <h3>Ops! Não existe nenhum produto aqui. Importe alguns <a href="{{ route('Produtos.create') }}">aqui</a></h3>
  @endif

  <session class="alert-session">
    @if(session('produto'))
      <div class="alert alert-success row-sm-12">
        <strong>Feito!</strong> Seu arquivo foi enviado, ele será processado e você poderá verificar o resultado em instantes
      </div>
    @endif
  </session>

</div>


<script type='text/javascript' src="{{ asset('js/fileList.js') }}"></script>

@stop
