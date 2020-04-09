	<form method="POST">

		<div class="card">
			<div class="card-body">
		

				<?php if(empty($verDetalhes)) : ;?>
					<div class="alert alert-danger" role="alert">
						ATENÇÃO ! <strong><?php echo $_SESSION['user_nomecompleto']; ?></strong> Alguém está precisando de sua ajuda.
					</div>
				<?php else : ;?>

					<div class="alert alert-info" role="alert">
						ATENÇÃO ! Vendo detalhes da Solicitação #<?php echo $lancamento['lanc_id'] ;?>.
					</div>
					
				<?php endif ;?>
				
				<hr>

				<div class="additional-content">
					<div class="alert alert-primary" role="alert">
						<p class="alert-heading">Descrição completa da Solicitação de Ajuda Selecionada #<?php echo $lancamento['lanc_id'] ;?></p>
						<p><?php echo $lancamento['lanc_descricao'] ;?></p>						
						<hr>
						<p class="mb-0">Meu Nome é : <?php echo $usuario_solicitou_ajuda['user_nomecompleto'] ;?></p>
						<p class="mb-0">Em que Cidade estou : <?php echo $usuario_solicitou_ajuda['user_cidade'] ;?></p>
						<p class="mb-0">Em que Bairro estou : <?php echo $usuario_solicitou_ajuda['user_bairro'] ;?></p>
						<p class="mb-0 text-primary"><strong>Prioridade : <?php echo $lancamento['lanc_prioridade'] ;?></strong></p>

						<!-- Esta vendo detalhes então mostra dados de quem Pediu Ajuda -->
						<?php if(!empty($verDetalhes)) : ;?>
								<hr>
								<div class="alert alert-warning" role="alert">
									ATENÇÃO ! <strong><?php echo $_SESSION['user_nomecompleto']; ?></strong> abaixo está o WhatsApp do(a) usuário <strong><?php echo $usuario_solicitou_ajuda['user_nomecompleto'] ;?></strong>. Entre em contato para continuar sua AJUDA. Parabéns por sua Atitude
								</div>
								<p class="mb-0">Nome  : <?php echo $usuario_solicitou_ajuda['user_nomecompleto'] ;?></p>
								<p class="mb-0">WhatsApp  : <?php echo $usuario_solicitou_ajuda['user_celular'] ;?></p>
								
									<?php 
										//Preparando telefone para Link Whats
										$txtcelular_replace = str_replace('-','',str_replace('(','',str_replace(')','',$usuario_solicitou_ajuda['user_celular'])));
									 ?>
								
								<p class="mb-0"> 
									<a href="https://wa.me/55<?php echo $txtcelular_replace ;?>?text=Olá vim a partir do sistema de ajuda voluntaria. Sou <?php echo $_SESSION['user_nomecompleto']; ?>" target="_blank"><i class="fa fa-whatsapp"></i>  Clique aqui para falar pelo WhatsApp</a>
								</p>

						<?php endif  ;?>
						

					</div>					
				</div>
						
				<div class="row">
					<div class="col">
						<div class="form-group">
							<a class="btn btn-secondary mt-4 pr-4 pl-4" href="<?php echo BASE_URL;?>home">Voltar</a>
						</div>   
					</div>

					<?php if(empty($verDetalhes)) : ;?>
						<div class="col text-right">
							<div class="form-group">
								<button name="btnAjudar" class="btn btn-success mt-4 pr-4 pl-4" type="submit">Quero Ajudar</button>						  									
							</div>   
						</div>
					<?php endif ;?>

				</div>
				
			</div>
		</div>
		

	</form>
