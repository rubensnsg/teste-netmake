<?php $nomeProjeto = "Inserir produto - Teste para Netmake";
require_once("header.php");

?>
<div class="col-12">
  <div class="row" style="justify-content: space-around;">
	<div class="col-12 col-lg-7">
		<div class="card mt-4 col-12">
		  <h5 class="card-header">
		  	<a href="home" class="btn btn-secondary btn-sm float-end">Voltar</a>
			Inserir Produtos
		  </h5>
		  <div class="card-body">
			<form id="form-produto" action="" method="post" class="col-12">
			  <div class="mb-3 row">
			    <label for="productname" class="col-12 col-md-4 col-form-label">Nome do Produto</label> 
			    <div class="col-12 col-md-8">
			      <input id="productname" name="productname" placeholder="Campo obrigatório" type="text" class="form-control" required="required" />
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="categoryid" class="col-12 col-md-4 col-form-label">Categoria</label> 
			    <div class="col-12 col-md-8">
			      <select id="categoryid" name="categoryid" class="form-select" required="required">
			        <option value="">Carregando</option>
			      </select>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="supplierid" class="col-12 col-md-4 col-form-label">Fornecedor</label> 
			    <div class="col-12 col-md-8">
			      <select id="supplierid" name="supplierid" class="form-select" required="required">
			        <option value="">Carregando</option>
			      </select>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="quantityperunit" class="col-12 col-md-4 col-form-label">Descrição</label> 
			    <div class="col-12 col-md-8">
			    	<textarea id="quantityperunit" name="quantityperunit" class="form-control"></textarea>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="unitprice" class="col-12 col-md-4 col-form-label">Preço unitário</label> 
			    <div class="col-12 col-md-6 col-xl-5">
			      <div class="input-group">
			        <div class="input-group-prepend">
			          <div class="input-group-text">R$</div>
			        </div> 
			        <input id="unitprice" class="form-control" name="unitprice" type="number" min="0" max="99999999999" step="0.01" pattern="^\d*(\.\d{0,2})?$" />
			      </div>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="totalvalue" class="col-12 col-md-4 col-form-label">Valor Total</label> 
			    <div class="col-12 col-md-6 col-xl-5">
			      <div class="input-group">
			        <div class="input-group-prepend">
			          <div class="input-group-text">R$</div>
			        </div>
			        <input id="totalvalue" class="form-control" name="totalvalue" type="number" min="0" max="99999999999" step="0.01" pattern="^\d*(\.\d{0,2})?$" />
			      </div>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="unitsinstock" class="col-12 col-md-4 col-form-label">Qtd. Estoque</label> 
			    <div class="col-12 col-md-5 col-xl-4">
			      <input id="unitsinstock" name="unitsinstock" type="number" min="0" max="99999999999" class="form-control" />
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="unitsonorder" class="col-12 col-md-4 col-form-label">Qtd. em Pedidos</label> 
			    <div class="col-12 col-md-5 col-xl-4">
			      <input id="unitsonorder" name="unitsonorder" type="number" min="0" max="99999999999" class="form-control" />
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <label for="reorderlevel" class="col-12 col-md-4 col-form-label">Nível Reabastecimento</label> 
			    <div class="col-12 col-md-5 col-xl-4">
			      <input id="reorderlevel" name="reorderlevel" type="number" min="0" max="99999999999" class="form-control" />
			    </div>
    			<small class="col-12 mt-2 mb-2 form-text text-muted">Com quantos produtos em estoque devemos fazer o pedido para o fornecedor</small>
			  </div>

			  <div class="mb-4 row">
			    <div id="situacao-fake-label" style="cursor: pointer;" class="col-12 col-md-4">Situação</div> 
			    <div class="col-12 col-md-8">
				    <div class="form-check form-switch">
					  <input class="form-check-input" type="checkbox" id="discontinued" name="discontinued" checked="checked" value="0" />
					  <label class="form-check-label" for="discontinued">
					  	Produto atualmente está <span id="discontinued-status">ativo</span>
					  </label>
					</div>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div class="offset-4 col-12 col-md-8">
			      <button name="submit" type="submit" class="btn btn-primary mx-2">Enviar</button>
			      <button name="resetar" type="reset" class="btn btn-secondary mx-2">Limpar Formulário</button>
			    </div>
			  </div>
			</form>
		  </div>
		  <!--<div class="card-footer">Produtos</div>-->
		</div>
	</div>

	<div class="col-12 col-lg-4">

		<div class="card my-4 col-12">
		  <h5 class="card-header">Categoria</h5>
		  <div class="card-body">
			<div class="col-12">
			  <div class="mb-3 row">
			    <div id="dadosCategoriaNome" class="col-12 col-form-label">
			      <strong>Nome: </strong><span></span>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div id="dadosCategoriaId" class="col-12 col-form-label">
			      <strong># ID: </strong><span></span>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div id="dadosCategoriaDescricao" class="col-12 col-form-label">
			      <strong>Descrição: </strong><span></span>
			    </div>
			  </div>
			</div>
		  </div>
		</div>

		<div class="card mt-4 col-12">
		  <h5 class="card-header">Fornecedores</h5>
		  <div class="card-body">
			<div class="col-12">
			  <div class="mb-3 row">
			    <div id="dadosFornecedoresEmpresa" class="col-12 col-form-label">
			      <strong>Nome Empresa: </strong><span></span>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div id="dadosFornecedoresContato" class="col-12 col-form-label">
			      <strong>Nome Contato: </strong><span></span>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div id="dadosFornecedoresContatoCargo" class="col-12 col-form-label">
			      <strong>Cargo Contato: </strong><span></span>
			    </div>
			  </div>

			  <div class="mb-3 row">
			    <div id="dadosFornecedoresContatoFone" class="col-12 col-form-label">
			      <strong>Cargo Telefone: </strong><span></span>
			    </div>
			  </div>
			</div>
		  </div>
		</div>

	</div>
  </div>
</div>

<?php require_once("footer.php"); ?>
<script type="text/javascript">
var categorias = {};
var fornecedores = {};
$(document).ready(function(){
	carregaCategorias();
	carregaFornecedores();

	$("#situacao-fake-label").on("click dbclick", function() {
		$(this).parent().find('label').click();
	})

	$("#discontinued").on("change", function(){
		if($(this).is(":checked")) {
			$("#discontinued-status").html("ativo");
		} else {
			$("#discontinued-status").html("descontinuado");
		}
	})

	$("#form-produto").on("submit", function(){
		// console.log($(this).serialize());
		$.ajax({
			url: "../produto",
			type: 'POST',
			data: $(this).serialize(),
			beforeSend: function(result){
			},
			success: function(result){
				// console.log(result);
				const json = JSON.parse(result);
				// console.log(json);

			  	if(json.mensagem == 'ok') {
			  		alert("Parabéns! O produto #ID " + json.data + " foi inserido com sucesso.");
			  		window.location.href="../home";
			  	}
			}
		})
		return false;
	})
})

$(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal); 
    }
  }, 0);
});

function carregaCategorias(){
  $.ajax({
    url: "../categorias",
    type: 'GET',
    beforeSend: function(result){
	    $("#categoryid").html('<option value="">Carregando</option>');
    },
    success: function(result){
    	const json = JSON.parse(result);

      	if(json.mensagem == 'ok') {
      		/* "mensagem": "ok",
			  "data": [...]
		    */

        	let ConteunoNovo = '<option value="">Selecione</option>';
	        $.each(json.data, function (key, item) {
        		categorias[item.categoryid] = item;

	        	/* 
	        	  "categoryid": "1",
			      "categoryname": "BEVERAGES",
			      "description": "SOFT DRINKS, COFFEES, TEAS, BEER AND LIQUOR",
			      "picture": "*nm*R0lGODlhyADIAOc...afd"
		        */
				ConteunoNovo += '<option value="';
				  ConteunoNovo += item.categoryid;
				ConteunoNovo += '">';
					ConteunoNovo += item.categoryname;
				ConteunoNovo += '</option>';
	        })

	        // console.log(ConteunoNovo);
	        $("#categoryid").html(ConteunoNovo).on("change", function(){
	        	if ($(this).val() > 0) {
					$("#dadosCategoriaNome span").html(categorias[$(this).val()].categoryid);
					$("#dadosCategoriaId span").html(categorias[$(this).val()].categoryname);
					$("#dadosCategoriaDescricao span").html(categorias[$(this).val()].description);
					/** Imagem foi comentada por que imagens no banco estão quebradas
					// $("#dadosCategoriaImagem span").html('<img src="data:image/png;base64,' + categorias[$(this).val()].picture + '" class="col-12" />');
					*/
	        	} else {
	        		$("#dadosCategoriaNome span, #dadosCategoriaId span, #dadosCategoriaDescricao span, #dadosCategoriaImagem span").html("");
	        	}
	        });
      	}
    },
  })
}

function carregaFornecedores(){
  $.ajax({
    url: "../fornecedores",
    type: 'GET',
    beforeSend: function(result){
	    $("#supplierid").html('<option value="">Carregando</option>');
    },
    success: function(result){
    	const json = JSON.parse(result);

      	if(json.mensagem == 'ok') {
      		/* "mensagem": "ok",
			  "data": [...]
		    */

        	let ConteunoNovo = '<option value="">Selecione</option>';
	        $.each(json.data, function (key, item) {
        		fornecedores[item.supplierid] = item;

	        	/* 
				  "supplierid": "1",
			      "companyname": "Exotic Liquids",
			      "contactname": "Charlotte Cooper",
			      "contacttitle": "Purchasing Manager",
			      "country": "UK",
			      "region": null,
			      "state": null,
			      "city": "0",
			      "postalcode": "EC1 4SD",
			      "address": "49 Gilbert St.",
			      "phone": "(171) 555-2222",
			      "fax": null,
			      "homepage": null
		        */
				ConteunoNovo += '<option value="';
				  ConteunoNovo += item.supplierid;
				ConteunoNovo += '">';
					ConteunoNovo += item.companyname;
				ConteunoNovo += '</option>';
	        })

	        // console.log(ConteunoNovo);
	        $("#supplierid").html(ConteunoNovo).on("change", function(){
	        	if ($(this).val() > 0) {
					$("#dadosFornecedoresEmpresa span").html(fornecedores[$(this).val()].companyname);
					$("#dadosFornecedoresContato span").html(fornecedores[$(this).val()].contactname);
					$("#dadosFornecedoresContatoCargo span").html(fornecedores[$(this).val()].contacttitle);
					$("#dadosFornecedoresContatoFone span").html(fornecedores[$(this).val()].phone);
	        	} else {
	        		$("#dadosFornecedoresEmpresa span, #dadosFornecedoresContato span, #dadosFornecedoresContatoCargo span, #dadosFornecedoresContatoFone span").html("");
	        	}
	        });
      	}
    },
  })
}

</script>
<?php require_once("fimhtml.php"); ?>