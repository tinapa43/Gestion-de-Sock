<style>
    .has-error{
        background-color: #f4433636;
    }
    .has-success{
        background-color: #4caf5061;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center"> M.A.J Stock Article [ <?= $depot->depot ?> ]</h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('Stocks/update_stock') ?>">
                        <input type="hidden" value="<?= $article->id_depot ?>" name="id_depot">
                        <input type="hidden" value="<?= $article->id_art ?>" name="id_art">
                        <input type="hidden" value="<?= $article->id_stock ?>" name="id_stock">
                            
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Article</th>
                                    <td> <?= $article->article_art ?> </td>
                                </tr>
                                <tr>
                                    <th>Référence</th>
                                    <td> <?= $article->ref_art ?> </td>
                                </tr>
                                <tr>
                                    <th>Désigniation</th>
                                    <td> <?= $article->desi_art ?> </td>
                                </tr>
                                <tr>
                                    <th>Prix Vente</th>
                                    <td> <?= $article->pv_art ?>DH </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 pull-right">
                            <div class="form-group">
                                <span>Qte Stocks</span>
                                <input type="number" class="form-control has-success" value="<?= $article->qte_stock ?>" name="qte_stock" placeholder="Qté stock"> <?= $article->unite_art ?>
                                <?php echo form_error('qte_stock'); ?>
                            </div>
                            
                            <button class="btn btn-md btn-info btn-block" name="btn-login" type="submit">  Modifier</button>
                        </div>
                        <span class="clearfix"></span>
                    </form>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>