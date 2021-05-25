<?php $nomeProjeto = "Árvore recursivo";
require_once("header.php");

?>
<div class="col-12">
	<div class="card mt-4">
	  <h5 class="card-header"> Árvore(recursivo) - Todos os subordinados abaixo de forma recursiva</h5>
	  <div class="card-body">
			<div class="table-responsive">
				<table id="tabelaPrincipal" class="table table-striped">
					<thead>
						<tr>
							<th style="text-align: center; width: 80px;"> # ID </th>
							<th> Nome Nó </th>
							<th> Nome Pai </th>
							<th style="text-align: center;"> Valor Nó </th>
							<th style="text-align: center;"> Valor(Nós subordinados) </th>
							<th style="text-align: center;"> Valor Total </th>
						</tr>
					</thead>
					<tbody id="respostaLista">
						<tr>
							<td class="procurando py-5" colspan="6">
								Procurando registros<br />
								<img alt="lupa procurando" src="src/img/search.gif" class="imagem-lupa" />
							</td>
						</tr>
					</tbody>
					<!--<tfoot></tfoot>-->
				</table>
			</div>

			<div class="row" style="display: flex; justify-content: space-between;">
				<nav id="paginacao" class="col-12 col-md-8 mt-3" aria-label="Page navigation example">
					<ul class="pagination">
					</ul>
				</nav>

				<div class="col-12 mt-3 col-md-4 row">
					<label for="quantidade-pagina" class="col-12 col-md-12 col-lg-8 col-form-label" style="text-align: right;">Linhas por página: </label>
					<div class="col-12 col-md-12 col-lg-4">
						<select id="quantidade-pagina" class="form-select" name="quantidade-pagina">
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="20" selected="selected">20</option>
							<option value="50">50</option>
						</select>
					</div>
				</div>
			</div>
	  </div>
	  <!--<div class="card-footer">Produtos</div>-->
	</div>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	ativaPesquisa(1, $("#quantidade-pagina").val());

	$("#quantidade-pagina").on("change", function(){
		ativaPesquisa(1, $("#quantidade-pagina").val());
	})
})

function ativaPesquisa(paginaAtual, quantidadePorPagina){
	/* if ($("#tabelaPrincipal").hasClass('carregando')) {
		alert("Aguarde finalizar a procura de registros atual");
	} else { */
	    $("#tabelaPrincipal").addClass('carregando');
      	$("#respostaLista").html('<tr><td class="procurando py-5" colspan="6">Procurando registros<br /><img alt="lupa procurando" src="src/img/search.gif" class="imagem-lupa" /></td></tr>');
	    var myForm = new Object();
	    myForm.pagina = paginaAtual;
	    myForm.limite = quantidadePorPagina;

	    enviandoConteudo(myForm);
	// }
}

function enviandoConteudo(conteudoForm){
  // console.log(conteudoForm);

  $.ajax({
    url: "../nodes/filtrar",
    type: 'GET',
    data: conteudoForm,
    beforeSend: function(result){
      // $("#respostaLista").html('<tr><td class="procurando py-5" colspan="6">Procurando registros<br /><img alt="lupa procurando" src="src/img/search.gif" class="imagem-lupa" /></td></tr>');
    },
    success: function(result){
    	const json = JSON.parse(result);

      	if(json.mensagem == 'ok') {
      		/* "mensagem": "ok",
			  "data": {
			    "paginaInicial": "1",
			    "paginaAtual": "1",
			    "paginaFinal": "8",
			    "quantidadeTotal": "77",
			    "quantidadePorPagina": "10",
			    "dados": [...]
		      }
		    */

        	let ConteunoNovo = '';
	        $.each(json.data.dados, function (key, item) {
	        	/* 
	        	  "node_id": "49",
		          "node_desc": "Node Q",
		          "node_value": "34.5",
		          "node_master": "3",
        		  "master_nome": "Node N",
		          "filhos_valor": "0",
		          "subordinados_valor": "0"
		        */
				ConteunoNovo += '<tr>';
					ConteunoNovo += '<td style="text-align: center;">';
						ConteunoNovo += item.node_id;
					ConteunoNovo += '</td>';
					ConteunoNovo += '<td>';
						ConteunoNovo += item.node_desc;
					ConteunoNovo += '</td>';
					ConteunoNovo += '<td>';
						ConteunoNovo += item.master_nome;
					ConteunoNovo += '</td>';
					ConteunoNovo += '<td style="text-align: center;">';
						ConteunoNovo += (item.node_value * 1).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
					ConteunoNovo += '</td>';
					ConteunoNovo += '<td style="text-align: center;">';
						ConteunoNovo += (item.subordinados_valor * 1).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
					ConteunoNovo += '</td>';
					ConteunoNovo += '<td style="text-align: center;">';
						ConteunoNovo += ((item.node_value * 1 + item.subordinados_valor * 1)).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
					ConteunoNovo += '</td>';
				ConteunoNovo += '</tr>';
	        })

	        // console.log(ConteunoNovo);
	        $("#respostaLista").html(ConteunoNovo);
	        $("#tabelaPrincipal").removeClass('carregando');

        	pagination(json.data.paginaInicial, json.data.paginaFinal, json.data.paginaAtual);
      	}
    },
  })
}

function pagination(startPage, lastPage, actualPage){
  var ConteunoNovo = '<li style="line-height: 34px; padding: 0 12px 0 6px;">Paginação: </li>';
  startPage = parseInt(startPage);
  lastPage = parseInt(lastPage);
  actualPage = parseInt(actualPage);

  // console.log(startPage, lastPage, actualPage);

  if((lastPage - startPage) > 10){
    // console.log("Entrou no if");
    if((actualPage - 5) >= startPage){
      startPage = actualPage - 5;
    }
    if((actualPage + 5) < lastPage){
      lastPage = actualPage + 5;
    }
  }

  for (var i = startPage; i <= lastPage; i++) {
    ConteunoNovo += '<li class="page-item';

    if(actualPage == i){
      ConteunoNovo += ' active';
    }else{
      ConteunoNovo += '" onclick="paginationClick(' + i + ')';
      // ConteunoNovo += 'onclick="paginationClick(' + i + ')" ';
    }

    ConteunoNovo += '" data-id="' + i + '"><a class="page-link" style="cursor: pointer;"> ';
    ConteunoNovo += i;
    ConteunoNovo += ' </a></li>';
  }
  
  // console.log(ConteunoNovo);
  $("#paginacao .pagination").html(ConteunoNovo);
  $("#paginacao").removeClass('carregando');
}

function paginationClick(paginaClicada){
	if ($("#paginacao").hasClass("carregando")){
	  alert("Aguarde a finalização do operação atual para continuar.");
	}else{
	  // console.log("Paginacao " + paginaClicada);
	  $("#paginacao").addClass('carregando');

	  ativaPesquisa(paginaClicada, $("#quantidade-pagina").val())
	}
}
</script>
<?php require_once("fimhtml.php"); ?>
