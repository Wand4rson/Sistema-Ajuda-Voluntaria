<br>

	<div class="alert alert-primary" role="alert">
		<strong>EDITAR SOLICITAÇÃO DE AJUDA</strong>
	</div>	

	<form method="POST">

		<div class="form-group">
			<?php if(!empty($msgErro)) : ;?>
				<div class="alert alert-danger" role="alert">
					Atenção ! <?php echo $msgErro ;?>
				</div>
			<?php endif ;?>
		</div>

		<div class="form-group">
			<label for="txtsolicitacao">Descrição da sua solicitação de Ajuda</label>
			<textarea class="form-control" id="txtsolicitacao" name="txtsolicitacao" rows="5" required><?php echo $lancamento['lanc_descricao'];?></textarea>
			<small class="form-text text-muted">* Descreva aqui sua Necessidade ou o que precisa de Ajuda</small>
		</div>

		<div class="form-group">
			<label class="col-form-label">Prioridade da sua Solicitação</label>
			<select class="custom-select" id="txtprioridade" name="txtprioridade">
				<option <?php echo ($lancamento['lanc_prioridade'] == 'Baixo') ? 'selected':'' ;?> value="Baixo">Baixo</option>
				<option <?php echo ($lancamento['lanc_prioridade'] == 'Medio') ? 'selected':'' ;?> value="Medio">Médio</option>
				<option <?php echo ($lancamento['lanc_prioridade'] == 'Urgente') ? 'selected':'' ;?> value="Urgente">Urgente</option>
			</select>
		</div>

		<div class="form-group">
			<button class="btn btn-success mt-4 pr-4 pl-4" type="submit">Editar Ajuda </button>   
		</div>   

	</form>