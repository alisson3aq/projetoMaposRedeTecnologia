<?php //$totalServico = 0;
//$totalProdutos = 0;?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Map OS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

</head>
<body style="background:#fff; ">

    <?php 
    
        for($i=0; $i<2; $i++){ 
        $totalServico = 0;
        $totalProdutos = 0;
      ?>
  <div class="container-fluid" style="width: 21cm; height: 29.7cm;">
    <div class="row-fluid">
      <div class="span12">
       
        <div class="invoice-content">
                <div class="invoice-head" style="margin-bottom: 0">

                    <table class="table">
                        <tbody>
                            <?php if ($emitente == null) {?>
                                        
                            <tr>
                                <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td style="width: 15%; align:center;"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                <td> <span style="font-size: 18px; "> <?php echo $emitente[0]->nome; ?></span> <br/><span><?php echo $emitente[0]->cnpj; ?> </br> <?php echo $emitente[0]->rua.', '.$emitente[0]->numero.' - '.$emitente[0]->bairro.' - '.$emitente[0]->cidade.' - '.$emitente[0]->uf; ?> </span> </br> <span> E-mail: <?php echo $emitente[0]->email.' - Fone: '.$emitente[0]->telefone; ?></span></td>
                                <td style="width: 18%; text-align: center">#OS: <span ><?php echo str_pad($result->idOs, 4, "0", STR_PAD_LEFT);?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y')?></span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                       
                    <table class="table" style="margin-top: 0">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5>Cliente</h5>
                                            <span><?php echo $result->nomeCliente?></span><br/>
                                            <span><?php echo $result->rua?>, <?php echo $result->numero?>, <?php echo $result->bairro?></span>, 
                                            <span><?php echo $result->cidade?> - <?php echo $result->estado?></span><br>
                                            <span>Celular: <?php echo $result->celular?></span>
                                        </li>
                                    </ul>
                                </td>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5>Responsável</h5></span>
                                            <span><?php echo $result->nome?></span> <br/>
                                            <span>Telefone: <?php echo $result->telefone?></span><br/>
                                            <span>Email: <?php echo $result->email?></span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
    
                </div>
            
                <table class="table" style="margin-top: 0; text-size:10px">
                <tr>
                    <?php if ($result->descricaoProduto != null) {?>
                        <td>
                            <h6>Descrição</h6></td>
                        <td><?php echo $result->descricaoProduto?></td>
                    <?php }?>
                    <?php if ($result->defeito != null) {?>
                        <td>
                            <h6>Defeito</h6>
                        </td>
                        <td>
                            <?php echo $result->defeito?>
                        </td>
                    <?php }?>
                </tr>
               
                <tr>
                    <?php if ($result->laudoTecnico != null) {?>
                        <td>
                            <h6>Laudo Técnico</h6>
                        </td>
                        <td>
                            <?php echo $result->laudoTecnico?>
                        </td>
                    <?php }?>
                    <?php if ($result->observacoes != null) {?>
                        <td>
                            <h6>Observações</h6>
                        </td>
                        <td>
                            <?php echo $result->observacoes?>
                        </td>
                    <?php }?>
                </tr>
               
                <tr>
                <?php if ($result->garantia != null) {?>
                        <td>
                            <h6>Garantia</h6>
                        </td>
                        <td colspan="3">
                            <?php echo $result->garantia?>
                        </td>
                    <?php }?>
                </tr>
                </table>

                <div style="margin-top: 0; padding-top: 0">

                 <?php if ($produtos != null) {?>
                    <table class="table table-bordered" id="tblProdutos>
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($produtos as $p) {

                                            $totalProdutos = $totalProdutos + $p->subTotal;
                                            echo '<tr>';
                                            echo '<td>'.$p->descricao.'</td>';
                                            echo '<td>'.$p->quantidade.'</td>';
                                            
                                            echo '<td>R$ '.number_format($p->subTotal, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        
                        <?php if ($servicos != null) {?>
                        <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            setlocale(LC_MONETARY, 'en_US');
                                            foreach ($servicos as $s) {
                                                $preco = $s->preco;
                                                $totalServico += $preco;
                                                echo '<tr>';
                                                echo '<td>'.$s->nome.'</td>';
                                                echo '<td>R$ '.number_format($s->preco, 2, ',', '.').'</td>';
                                                echo '</tr>';
                                            }?>

                                        <tr>
                                            <td colspan="1" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php  echo number_format($totalServico, 2, ',', '.');?></strong></td>
                                            <br/>
                                        </tr>
                                        </tbody>
                                    </table>
                        <?php }?>
                        <hr />
                    
                        <h4 style="text-align: right">Valor Total: R$ <?php echo number_format($totalProdutos + $totalServico, 2, ',', '.');?></h4>
                       
                </div>
                
            </div>                
      </div>
    </div>
  </div>
 <?php } ?>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 

<script>
        window.print();
</script>

</body>
</html>







