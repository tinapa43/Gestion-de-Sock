<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">

            
            <div class="panel panel-info col-sm-12 col-md-12">
                <h1 class="panel-heading text-center login-title">Fournisseurs </h1>
                
                <?php if(isset($msg)) { echo $msg; }; ?> 
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Config/add_frs') ?>">

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
                    
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Adress</th>
                                    <th>Tel</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($frs): foreach($frs as $row):  ?>
                                <tr> <form class="form-signin" method="POST" action="<?php echo base_url('Config/update_frs') ?>">
                                    <td> <input name="id_frs" type="hidden" class="form-control"  value="<?= $row->id_frs ?>" > <?= $row->id_frs ?> </td>
                                    <td> <input name="nom" type="text" class="form-control"  value="<?= $row->nom_frs  ?>" ></td>
                                    <td> <input name="adress" type="text" class="form-control"  value="<?= $row->adress_frs ?>" ></td>
                                    <td> <input name="tel" type="text" class="form-control"  value="<?= $row->tel_frs ?>" ></td>
                                    <td> <input name="visible" type="text" class="form-control"  value="<?= $row->visible_frs ?>" ></td>
                                    <td>
                                        <button class="btn btn-sm btn-success btn-block" > Update </button>
                                    </td>
                                </form></tr>
                                
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        
                        <span class="clearfix"></span>
                  
                </div>
            </div>
            
            <div class="panel panel-success col-sm-12 col-md-12">
                <h1 class="panel-heading text-center login-title"> Clients </h1>
                
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
                    
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Adress</th>
                                    <th>Tel</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($clt): foreach($clt as $row):  ?>
                                <tr> <form class="form-signin" method="POST" action="<?php echo base_url('Config/update_clt') ?>">
                                    <td> <input name="id_clt" type="hidden" class="form-control"  value="<?= $row->id_clt ?>" > <?= $row->id_clt ?> </td>
                                    <td> <input name="nom" type="text" class="form-control"  value="<?= $row->nom_clt  ?>" ></td>
                                    <td> <input name="adress" type="text" class="form-control"  value="<?= $row->adress_clt ?>" ></td>
                                    <td> <input name="tel" type="text" class="form-control"  value="<?= $row->tel_clt ?>" ></td>
                                    <td> <input name="visible" type="text" class="form-control"  value="<?= $row->visible_clt ?>" ></td>
                                    <td>
                                        <button class="btn btn-sm btn-success btn-block" > Update </button>
                                    </td>
                                </form></tr>
                                
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        
                        <span class="clearfix"></span>
                    
                </div>
            </div>
        </div>
    </div>
</div>