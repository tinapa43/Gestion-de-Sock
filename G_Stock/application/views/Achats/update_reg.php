<div class="col-md-9" style="margin-top: 5px">
    <div class="article">
        <div class="col-sm-12 col-md-11 col-md-offset-1">
            <h1 class="text-center login-title"> Payement Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <div class="col-md-6">
                            <div class="form-group">
                                <span>Fournisseur</span>
                                <input type="text" class="form-control" value="<?= $article->nom_frs ?>" disabled>
                            </div>

                            <div class="form-group">
                                <span>Article :</span>
                                <input type="text" class="form-control" value="<?= $article->article_art ?>" disabled>
                            </div>
                            <div class="form-group">
                                <span>Référence :</span>
                                <input type="text" class="form-control" value="<?= $article->ref_art ?>" disabled>
                                <?php echo form_error('ref'); ?>
                            </div>
                            <div class="form-group">
                                <span>Designiation :</span>
                                <input type="text" class="form-control" value="<?= $article->desi_art ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <span>Mantant Restant :</span>
                                <input type="text" class="form-control" value="<?= $article->prix_art ?>" disabled>
                            </div>
                        
                            <span class="clearfix"></span>
                    </div>
                    <div class="col-md-6">
                         <form class="form-signin" method="POST" action="<?= base_url('Achats/add_reglement') ?>">
                            <input type="hidden" value="<?= $article->id_achat ?>" name="id_achat">
                            <input type="hidden" value="<?= $article->id_art ?>" name="article">
                            <div class="form-group">
                                <span>Type Reglements</span>
                                <select type="text" class="form-control" name="type_reg" placeholder="Fournisseur">
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
                            <button class="btn btn-md btn-success btn-block" name="btn-login" type="submit">  Ajouter</button>
                        </form>
                    </div>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>