<div class="container" >
    <div class="row">
        <div class="col-md-12 ">

            <div class="col-md-6 panel panel-primary">
                <h1 class="panel-heading text-center login-title">Famills d'Article </h1> 
                
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Config/add_famill') ?>">

                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" >
                            <?php echo form_error('titre_art'); ?>
                        </div>
                        
                        <div class="col-md-4 form-group">
                           <button class="btn btn-sm btn-primary btn-block"  type="submit">  Ajouter</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                </div>
                <hr>
                <div class="account-wall">
                    
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Famills</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($famill): foreach($famill as $row):  ?>
                                <tr><form class="form-signin" method="POST" action="<?php echo base_url('index.php/Config/update_famill') ?>">
                                    <td> <input type="hidden" name="id_famill"  value="<?= $row->id_famill  ?>" > <?= $row->id_famill ?></td>
                                    <td> <input type="text" name="famill" class="form-control" value="<?= $row->famill  ?>" > </td>
                                    <td> <input type="text" name="visible" class="form-control" value="<?= $row->visible_famill  ?>" > </td>
                                    <td>
                                        <button class="btn btn-success btn-sm btn-block" > Update </button>
                                    </td>
                                </form></tr>
                                
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        
                        <span class="clearfix"></span>
                    
                </div>
            </div>
            
            <div class="col-md-6 panel panel-danger">
                <h1 class="panel-heading text-center login-title">Unite d'Article </h1>
                
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Config/add_unite') ?>">

                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" >
                            <?php echo form_error('nom'); ?>
                        </div>
                        
                        <div class="col-md-4 form-group">
                           <button class="btn btn-sm btn-primary btn-block"  type="submit">  Ajouter</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                </div>
                <hr>
                <div class="account-wall">
                    
                        <table id="data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Unite</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($unite): foreach($unite as $row):  ?>
                                <tr><form class="form-signin" method="POST" action="<?php echo base_url('index.php/Config/update_unite') ?>">
                                    <td> <input type="hidden" name="id_unite"  value="<?= $row->id_unite  ?>" > <?= $row->id_unite ?></td>
                                    <td> <input type="text" name="unite" class="form-control" value="<?= $row->unite  ?>" > </td>
                                    <td> <input type="text" name="visible" class="form-control" value="<?= $row->visible_unite  ?>" > </td>
                                    <td>
                                        <button class="btn btn-success btn-sm btn-block" > Update </button>
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