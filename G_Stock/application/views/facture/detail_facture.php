
<style type="text/css">

    .pied{
            display:none;
        }
    @media print {
        nav * {
            display:none;
        }
        html{
            padding: 0;
            margin: 0;
        }
        body{
            padding: 0;
            margin: 0;
        }
        .printer { 
            display:block;
            width: 100%; 
            height: 100%;
            margin: 0;
            margin-top: 5px;
            margin-bottom: 5px;  
            padding-top: 0px;
        }
        .well{
            width: 100%;
            height: auto;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            border:none;     
        }
        .pied{
            display:block;
            position: fixed;
            bottom: 0px;
            width: 90%;;
            margin: 0;
            padding: 0;
            clear:both;
        }
        .button{
            display:none;
        }
    }
</style>
    <div class="container printer">
        <div  class="well col-xs-12 col-sm-8 col-md-8">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <p>
                            <em>Adress: <?= $row->adress_info ?></em>
                            <br>
                            <em>Tél: <?= $row->tel_info ?></em>
                            <br>
                            <em>Fax: <?= $row->fax_info ?></em>
                            <br>
                            <em> Dépot: <?= $info->depot ?></em>
                            
                        </p>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <h1 class="text-right"><?= $row->ste_info ?></h1>
                    <hr>
                    <em>Date: <?= $info->created_ligne ?></em>
                    <br>
                    <em>Fournisseur: <?= $info->nom_frs ?></em>
                    <br>
                    <em>Tél: <?= $info->tel_frs ?></em>
                    <br>
                    <em>Adresse: <?= $info->adress_frs ?></em>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1><?= $info->type ?> N°: <?= $info->id_ligne ?></h1>
                </div>
                </span>
                <table class="table table-striped" style="border-collapse: collapse; border: 1px solid #8080804d;">
                    <thead>
                        <tr>
                            <th>Articles</th>
                            <th>#</th>
                            <th class="text-center">Qté CMD</th>
                            <th class="text-center">Remise</th>
                            <th class="text-center">TVA</th>
                            <th class="text-center">HT</th>
                            <th class="text-center">TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $ttc=0;$ht=0;$tva=0; if($list): foreach ($list as $row): ?>
                        <?php
                                $ttc = $ttc + round( $row->ttc_list, 2);
                                $ht  = $ht + round( $row->ht_list, 2);
                                $tva = $tva + ($row->tva_list * $row->ht_list /100 ) ;
                        ?>
                        <tr>
                            <td> <?= $row->desi_art ?></td>
                            <td> </td>
                            <td class="text-center"> <?= $row->qte_list ?></td>
                            <td class="text-center"> <?= $row->remise_list ?></td>
                            <td class="text-center"> <?= $row->tva_list ?></td>
                            <td class="text-center"> <?= round( $row->pv_art, 2) ?></td>
                            <td class="text-center"> <?= round( $row->pv_art * $row->qte_list, 2)  ?></td>
                        </tr>
                        
                        <?php  endforeach; endif; ?>
                        
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td class="text-right">
                            <p>
                                <strong>Total HT:</strong>
                            </p>
                            <p>
                                <strong>Tax:</strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong> <?= $ht ?> DH</strong>
                            </p>
                            <p>
                                <strong><?= $tva ?> DH</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td class="text-right"><h4><strong>Total TTC:</strong></h4></td>
                            <td class="text-center text-danger"><h4><strong><?= $ttc ?></strong> DH</h4></td>
                        </tr>
                        
                    </tbody>
                </table>
                
            </div>
            <div class="row pied col-xs-12 text-center">
                <hr>
                Info Sté
            </div>
        </div>
        <div class="col-md-4 button">
            <a href="javascript:window.print()" class="btn btn-warning btn-lg"> Imprimer </a>
        </div>
    </div>