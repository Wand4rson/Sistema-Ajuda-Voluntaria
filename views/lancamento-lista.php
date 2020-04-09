<div class="card">
		<div class="card-body">
			<div class="alert alert-primary">
				<h4 class="header-title text-center">SUAS SOLICITAÇÕES DE AJUDA</h4>
			</div>
			<div class="single-table">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
                                <th scope="col">ID</th>
								<th scope="col">Prioridade</th>
								<th scope="col">Descrição</th>
								<th scope="col">Solicitado em</th>
								<th scope="col">Status</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>

						<tbody>

						<?php foreach($lista as $item) : ;?>
							<tr>
                                <td><small><?php echo $item['lanc_id'] ;?></small></td>

								<td>										
										<?php if($item['lanc_prioridade'] === 'Baixo')  : ;?>
											<strong><p class="text-primary"><?php echo $item['lanc_prioridade'] ;?></p></strong>
										<?php elseif($item['lanc_prioridade'] === 'Medio')  : ;?>
											<strong><p class="text-warning"><?php echo $item['lanc_prioridade'];?></p></strong>
										<?php elseif($item['lanc_prioridade'] === 'Urgente')  : ;?>
											<strong><p class="text-danger"><?php echo$item['lanc_prioridade'];?></p></strong>
										<?php endif;?>

								</td>

                                <td>
									<?php echo substr($item['lanc_descricao'],0,30)." ..." ;?>

                                    <?php if($item['user_id_voluntario'] != '0')  : ;?>
                                        <br><small>Ajudado por : <?php echo $item['nome_usuario_voluntario'] ;?></small>
                                    <?php endif;?>

                                    <?php if($item['user_id_concluido'] != '0')  : ;?>
                                        - <small>Concluido por : <?php echo $item['nome_usuario_concluiu'] ;?></small>
                                    <?php endif;?>

                                    


                                </td>
                                
								<td><small><?php echo date('d/m/Y \a\s\ H:i', strtotime($item['lanc_datahoralancamento'])) ;?></small></td>
								
								<td>
									
									<?php if($item['lanc_status_solicitacao'] === '0')  : ;?>
										<?php echo "Aberto" ;?>
									<?php elseif($item['lanc_status_solicitacao'] === '1')  : ;?>
                                        <small class='text-success'><?php echo "Concluido" ;?>
                                            <br>em <?php echo date('d/m/Y \a\s\ H:i', strtotime($item['lanc_datahoraconcluido'])) ;?>
                                        </small>
                                        
									<?php elseif($item['lanc_status_solicitacao'] === '2')  : ;?>
                                        <p class='text-info'><?php echo "Em Andamento" ;?></p>                                        
									<?php elseif($item['lanc_status_solicitacao'] === '3')  : ;?>
										<p class='text-danger'><del><?php echo "Cancelado" ;?></del></p>
									<?php endif;?>

								</td>

								<td>
									<ul class="d-flex">	
                                        <?php if($item['lanc_status_solicitacao'] === '0')  : ;?>
                                            <li class="mr-2"><a href="<?php echo BASE_URL;?>lancamento/editar/<?php echo $item['lanc_id'];?>" class="alert alert-info"><i class="fa fa-edit"></i></a></li>
                                            <li class="mr-2"><a href="<?php echo BASE_URL;?>lancamento/cancelar/<?php echo $item['lanc_id'];?>" class="alert alert-danger"><i class="fa fa-trash"></i></a></li>                                    
                                        <?php elseif($item['lanc_status_solicitacao'] === '2')  : ;?>                                       
                                            <li class="mr-2"><a href="<?php echo BASE_URL;?>lancamento/concluir/<?php echo $item['lanc_id'];?>" class="alert alert-success"><i class="fa fa-check-square"></i></a></li>                                        
                                        <?php endif;?>
									</ul>
								</td>
							</tr>

							<?php endforeach ;?>
							
						</tbody>
					</table>

					<!-- Só mostrar paginação se exitir lançamentos -->
					<?php if(count($lista) > 0) : ;?>
						<div class="card">
							<div class="card-body">										
								<nav aria-label="...">
									<ul class="pagination justify-content-center">
										
										<!-- Pagina Inicial = 1 -->
										<li class="page-item">
											<a class="page-link" href="<?php echo BASE_URL;?>lancamento/suassolicitacoes?pagina=1" tabindex="-1">Primeira</a>
										</li>
								
										<?php for($i=1 ; $i<=$qtde_seletores_paginas_mostrar;$i++) : ;?>
											<!-- Marca Pagina Ativa no paginador -->
											<?php if ($pagina_atual == $i){ $class_active = 'active'; }else{ $class_active =''; }?>

											<!-- Monta Link Paginador -->
											<li class="page-item <?php echo $class_active; ?>"><a class="page-link" href="<?php echo BASE_URL;?>lancamento/suassolicitacoes?pagina=<?php echo $i;?>"><?php echo $i;?></a></li>
										<?php endfor ;?>

										<!-- Pagina Final -->
										<li class="page-item">
											<a class="page-link" href="<?php echo BASE_URL;?>lancamento/suassolicitacoes?pagina=<?php echo $qtde_seletores_paginas_mostrar;?>">Ultima</a>
										</li>
										
									</ul>
								</nav>
							</div>
						</div>
					<?php endif ;?>
					<!--Fim de mostrar paginação se existir lançamentos -->

				</div>
			</div>
		</div>
	</div>