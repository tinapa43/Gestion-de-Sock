<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center"> Achats Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Achats/add_reg') ?>">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="achat" value="<?= $data->id_achat ?>">
                            <div class="form-group">
                                <span>Fournisseur</span>
                                <select type="text" class="form-control search" name="frs" placeholder="Fournisseur">
                                    <?php if($frs): foreach($frs as $row):  ?>
                                    <option value="<?= $row->id_frs ?>"><?= $row->nom_frs ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('frs'); ?>
                            </div>
                            <div class="form-group">
                                <span>Articles</span>
                                <select type="text" class="form-control search" name="article" placeholder="Fournisseur">
                                    <?php if($art): foreach($art as $row):  ?>
                                    <option value="<?= $row->id_art ?>"><?= $row->article_art.' - '.$row->ref_art ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('article'); ?>
                            </div>
                            <div class="form-group">
                                <span>Type Reglements</span>
                                <select type="text" class="form-control search" name="type_reg" placeholder="Fournisseur">
                                   <option value="cheque"> Cheque</option>
                                   <option value="espece"> Espece</option>
                                   <option value="virement"> Virement </option>
                                </select>
                                <?php echo form_error('type_reg'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="prix_reg" placeholder="Prix Payer">
                                <?php echo form_error('prix_reg'); ?>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" name="btn-login" id="btn-login" type="submit">  Ajouter</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>