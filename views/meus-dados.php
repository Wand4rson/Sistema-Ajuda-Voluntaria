
<br>
<div class="alert alert-primary" role="alert">
    <strong>EDITANDO MEUS DADOS</strong>
</div>	

<form method="POST" action="<?php echo BASE_URL;?>usuario/editar_action">

    <div class="form-group">
        <?php if(!empty($msgErro)) : ;?>
            <div class="alert alert-danger" role="alert">
                Atenção ! <?php echo $msgErro ;?>
            </div>
        <?php endif ;?>
    </div>

    <div class="form-group">
        <label for="txtnomecompleto">Nome Completo</label>
        <input class="form-control" type="text" id="txtnomecompleto" name="txtnomecompleto" value="<?php echo $usuario['user_nomecompleto'] ;?>">           
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="txtcelular">Celular</label>
                <input class="form-control" type="text" id="txtcelular" name="txtcelular" value="<?php echo $usuario['user_celular'] ;?>" disabled>
                <small class="form-text text-muted"> ** Caso necessite alterar o celular envie um email para o suporte.</small>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="txtemail">E-mail</label>
                <input class="form-control" type="email" id="txtemail" name="txtemail" value="<?php echo $usuario['user_email'] ;?>" disabled>
                <small class="form-text text-muted"> ** Caso necessite alterar o e-mail envie um email para o suporte.</small>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="txtsenhaacesso">Senha de acesso</label>
        <input class="form-control" type="password" id="txtsenhaacesso" name="txtsenhaacesso" value="">
        <small class="form-text text-danger"> ** Caso não queira alterar a senha de acesso deixe em branco este campo.</small>
    </div>

    <div class="form-group">
        <label for="txtcep">CEP</label>
        <input class="form-control" type="text" id="txtcep" name="txtcep" value="<?php echo $usuario['user_cep'] ;?>">           
    </div>

    <div class="form-group">
        <label for="txtestado">Estado</label><br>
        <select class="custom-select" id="txtestado" name="txtestado">                               
            <option <?php echo ($usuario['user_estado'] == 'AC') ? 'selected':'' ;?>  value="AC">Acre</option>
            <option <?php echo ($usuario['user_estado'] == 'AL') ? 'selected':'' ;?>  value="AL">Alagoas</option>
            <option <?php echo ($usuario['user_estado'] == 'AP') ? 'selected':'' ;?>  value="AP">Amapá</option>
            <option <?php echo ($usuario['user_estado'] == 'AM') ? 'selected':'' ;?>  value="AM">Amazonas</option>
            <option <?php echo ($usuario['user_estado'] == 'BA') ? 'selected':'' ;?>  value="BA">Bahia</option>
            <option <?php echo ($usuario['user_estado'] == 'CE') ? 'selected':'' ;?>  value="CE">Ceará</option>
            <option <?php echo ($usuario['user_estado'] == 'DF') ? 'selected':'' ;?>  value="DF">Distrito Federal</option>
            <option <?php echo ($usuario['user_estado'] == 'ES') ? 'selected':'' ;?>  value="ES">Espirito Santo</option>
            <option <?php echo ($usuario['user_estado'] == 'GO') ? 'selected':'' ;?>  value="GO">Goiás</option>
            <option <?php echo ($usuario['user_estado'] == 'MA') ? 'selected':'' ;?>  value="MA">Maranhão</option>
            <option <?php echo ($usuario['user_estado'] == 'MS') ? 'selected':'' ;?>  value="MS">Mato Grosso do Sul</option>
            <option <?php echo ($usuario['user_estado'] == 'MT') ? 'selected':'' ;?>  value="MT">Mato Grosso</option>
            <option <?php echo ($usuario['user_estado'] == 'MG') ? 'selected':'' ;?>  value="MG">Minas Gerais</option>
            <option <?php echo ($usuario['user_estado'] == 'PA') ? 'selected':'' ;?>  value="PA">Pará</option>
            <option <?php echo ($usuario['user_estado'] == 'PB') ? 'selected':'' ;?>  value="PB">Paraíba</option>
            <option <?php echo ($usuario['user_estado'] == 'PR') ? 'selected':'' ;?>  value="PR">Paraná</option>
            <option <?php echo ($usuario['user_estado'] == 'PE') ? 'selected':'' ;?>  value="PE">Pernambuco</option>
            <option <?php echo ($usuario['user_estado'] == 'PI') ? 'selected':'' ;?>  value="PI">Piauí</option>
            <option <?php echo ($usuario['user_estado'] == 'RJ') ? 'selected':'' ;?>  value="RJ">Rio de Janeiro</option>
            <option <?php echo ($usuario['user_estado'] == 'RN') ? 'selected':'' ;?>  value="RN">Rio Grande do Norte</option>
            <option <?php echo ($usuario['user_estado'] == 'RS') ? 'selected':'' ;?>  value="RS">Rio Grande do Sul</option>
            <option <?php echo ($usuario['user_estado'] == 'RO') ? 'selected':'' ;?>  value="RO">Rondônia</option>
            <option <?php echo ($usuario['user_estado'] == 'RR') ? 'selected':'' ;?>  value="RR">Roraima</option>
            <option <?php echo ($usuario['user_estado'] == 'SC') ? 'selected':'' ;?>  value="SC">Santa Catarina</option>
            <option <?php echo ($usuario['user_estado'] == 'SP') ? 'selected':'' ;?>  value="SP">São Paulo</option>
            <option <?php echo ($usuario['user_estado'] == 'SE') ? 'selected':'' ;?>  value="SE">Sergipe</option>
            <option <?php echo ($usuario['user_estado'] == 'TO') ? 'selected':'' ;?>  value="TO">Tocantins</option>
        </select>                            
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="txtcidade">Cidade</label>
                <input class="form-control" type="text" id="txtcidade" name="txtcidade" value="<?php echo $usuario['user_cidade'] ;?>">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="txtbairro">Bairro</label>
                <input class="form-control" type="text" id="txtbairro" name="txtbairro" value="<?php echo $usuario['user_bairro'] ;?>">
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <button class="btn btn-success mt-4 pr-4 pl-4" type="submit">Alterar </button>   
    </div>   

</form>


