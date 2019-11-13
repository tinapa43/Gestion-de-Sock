<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-warning">
            <h1 class="panel-heading text-center"> Ajouter Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Stocks/add_article') ?>">
                        
                         <div class="form-group">
                            <span>Depots</span>
                            <select type="text" class="form-control search" name="depot">
                                <?php if($depot): foreach($depot as $row):  ?>
                                <option value="<?= $row->id_depot ?>"><?= $row->depot ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                            <a href="<?= base_url('Depots/add_depot') ?>" class="btn btn-default btn-xs pull-right">Nouveau</a>
                            <?php echo form_error('depot'); ?>
                        </div>
                        <div class="form-group">
                            <span>Famills</span>
                            <select type="text" class="form-control search" name="famill">
                                <?php if($famill): foreach($famill as $row):  ?>
                                <option value="<?= $row->id_famill ?>"><?= $row->famill ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                            <a href="<?= base_url('Config/add_famill') ?>" class="btn btn-default btn-xs pull-right">Nouveau</a>
                            <?php echo form_error('famill'); ?>
                        </div>
                            
                        <div class="form-group">
                            <span>Article</span>
                            <input type="text" class="form-control" name="titre_art" placeholder="Article" >
                            <?php echo form_error('titre_art'); ?>
                        </div>
                        <div class="form-group">
                            <span>Référence</span>
                            <input type="text" class="form-control" name="reference" placeholder="Référence" >
                            <?php echo form_error('reference'); ?>
                        </div>
                        <div class="form-group">
                            <span>Désigniation</span>
                            <input type="text" class="form-control" name="designiation" placeholder="Désigniation" >
                            <?php echo form_error('designiation'); ?>
                        </div>
                        <div class="form-group">
                            <span>Prix Vente</span>
                            <input type="text" class="form-control" name="pu" placeholder="Prix Vente">
                            <?php echo form_error('pu'); ?>
                        </div>
                        <div class="form-group">
                            <span>Qte Alert</span>
                            <input type="text" class="form-control" name="qte" placeholder="Quantitè Alert">
                            <?php echo form_error('qte'); ?>
                        </div>
                        <div class="form-group">
                            <span>Unité</span>
                            <select type="text" class="form-control search" name="unite">
                                <?php if($unite): foreach($unite as $row):  ?>
                                <option value="<?= $row->id_unite ?>"><?= $row->unite ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                            <a href="<?= base_url('Config/add_famill') ?>" class="btn btn-default btn-xs pull-right">Nouveau</a>
                            <?php echo form_error('unite'); ?>
                        </div>
                        <hr>
                        <button class="btn btn-lg btn-primary btn-block" name="btn-login" id="btn-login" type="submit">  Ajouter</button>

                        <span class="clearfix"></span>
                    </form>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>