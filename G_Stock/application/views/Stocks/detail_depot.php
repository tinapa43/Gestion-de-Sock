<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-info">
            <h1 class="panel-heading text-center"> List stock Article disponible à [ <?=  $info->depot ?> ]:  </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <hr>
            <div class="account-wall">
                <form class="form-signin" method="POST" action="<?php echo base_url() ?>">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Article</th>
                                <th>Désigniantion</th>
                                <th>Quantité Stocks</th>
                                <th>Prix Vente</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td> <?= $row->desi_art ?></td>
                                <td class="text-right"> <?= $row->qte_stock ?> <?= $row->unite_art ?> </td>
                                <td class="text-right"> <?= $row->pv_art ?> DH</td>
                                <td>
                                    <a href="<?= base_url('Stocks/MAJ_Article/'.$row->id_art) ?>" class="btn btn-sm btn-primary btn-block" > Détail</a>
                                    <a href="<?= base_url('Stocks/MAJ_Stock/'.$row->id_stock) ?>" class="btn btn-sm btn-success btn-block" >  Stock</a>
                                </td>
                            </tr>
                            
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    
                    <span class="clearfix"></span>
                </form>
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>