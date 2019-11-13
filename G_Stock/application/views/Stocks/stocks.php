<div class="col-md-9" style="margin-top: 5px">
    <div class="row">
        <div class="col-sm-12 col-md-11 col-md-offset-1">
            <h1 class="text-center">Lits Stocks </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
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
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td> <?= $row->desi_art ?></td>
                                <td> 0 </td>
                                <td> <?= $row->pv_art ?></td>
                                <td> <?= $row->create_art ?></td>
                                <td>
                                    <a href="<?= base_url('Stocks/MAJ_Stock').'/'.$row->id_art ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
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