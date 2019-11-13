<div class="col-md-9" style="margin-top: 5px">
    <div class="row">
        <div class="col-sm-12 col-md-11 col-md-offset-1">

            <h1 class="text-center login-title"> Clients </h1>
            <hr>
            <div class="col-sm-12 col-md-8">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Config/add_clt') ?>">

                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" >
                            <?php echo form_error('titre_art'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" name="adress" placeholder="Adress" >
                            <?php echo form_error('adress'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" name="tel" placeholder="Tél" >
                            <?php echo form_error('tel'); ?>
                        </div>

                        <div class="col-md-3 form-group">
                           <button class="btn btn-sm btn-primary btn-block"  type="submit">  Ajouter</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                </div>
                <hr>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?php echo base_url() ?>">
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Adress</th>
                                    <th>Tel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($clt): foreach($clt as $row):  ?>
                                <tr>
                                    <td> <?= $row->id_clt ?></td>
                                    <td> <?= $row->nom_clt  ?></td>
                                    <td> <?= $row->adress_clt ?></td>
                                    <td> <?= $row->tel_clt ?></td>
                                    <td>
                                        <a href="<?= base_url('Config/delete_clt').'/'.$row->id_clt ?>" class="btn btn-sm btn-danger btn-block" >  Delete</a>
                                    </td>
                                </tr>
                                
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        
                        <span class="clearfix"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>