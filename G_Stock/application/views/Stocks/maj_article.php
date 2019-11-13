<style>
    .has-error{
        background-color: #f4433636;
    }
    .has-success{
        background-color: #4caf5061;
    }
</style>
<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center">  Mise a jour l'Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <div class="col-md-6">
                        <?php if($article): ?>
                        <form class="form-signin" method="POST" action="<?= base_url('Stocks/update_article') ?>">
                            <input type="hidden" value="<?= $article->id_art ?>" name="id_art">
                            <input type="hidden" value="<?= $article->id_stock ?>" name="id_mag">
                            
                            
                            <div class="form-group">
                                <span>Famills</span>
                                <select type="text" class="form-control search" name="famill">
                                    <option value="<?= $article->id_famill ?>"><?= $article->famill ?></option>
                                    <?php if($famill): foreach($famill as $row):  ?>
                                    <option value="<?= $row->id_famill ?>"><?= $row->famill ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <a href="<?= base_url('Config/add_famill') ?>" class="btn btn-default btn-xs pull-right">Nouveau</a>
                                <?php echo form_error('famill'); ?>
                            </div>
                            
                            <div class="form-group">
                                <span>Article</span>
                                <input type="text" class="form-control" value="<?= $article->article_art ?>" name="article" placeholder="Article" >
                                <?php echo form_error('article'); ?>
                            </div>
                            
                            <div class="form-group">
                                <span>Référence</span>
                                <input type="text" class="form-control" value="<?= $article->ref_art ?>" name="ref" placeholder="Référence" >
                                <?php echo form_error('ref'); ?>
                            </div>
                            <div class="form-group">
                                <span>Désigniation</span>
                                <input type="text" class="form-control" value="<?= $article->desi_art ?>" name="desi" placeholder="Désigniation" >
                                <?php echo form_error('desi'); ?>
                            </div>
                            <div class="form-group">
                                <span>Prix Vente</span>
                                <input type="text" class="form-control" value="<?= $article->pv_art ?>" name="pu" placeholder="Prix Unitaire">
                                <?php echo form_error('pu'); ?>
                            </div>
                            <div class="form-group">
                                <span>Qte Alert</span>
                                <input type="number" class="form-control has-error" value="<?= $article->qte_min_art ?>" name="qte" placeholder="Qté Alert">
                                <?php echo form_error('qte'); ?>
                            </div>
                            
                            <!--div class="form-group">
                                <span>Qte Stocks</span>
                                <input type="number" class="form-control has-success" value="<?= $article->qte_stock ?>" name="qte_stock" placeholder="Qté stock">
                                <?php echo form_error('qte_stock'); ?>
                            </div-->
                            <div class="form-group">
                                <span>Unité</span>
                                <select type="text" class="form-control search" name="unite">
                                    <option value="<?= $article->unite_art ?>"><?= $article->unite_art ?></option>
                                    <?php if($unite): foreach($unite as $row):  ?>
                                    <option value="<?= $row->unite ?>"> <?= $row->unite ?> </option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <a href="<?= base_url('Config/add_famill') ?>" class="btn btn-default btn-xs pull-right">Nouveau</a>
                                <?php echo form_error('unite'); ?>
                            </div>
                            <hr>
                            <button class="btn btn-md btn-info btn-block" name="btn-login" type="submit">  Modifier</button>
                            <span class="clearfix"></span>
                        </form>
                        <?php endif; ?>
                        <hr>
                    </div>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>