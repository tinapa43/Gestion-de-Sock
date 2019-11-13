<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-warning">
            <h1 class="panel-heading text-center"> Dépots </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <div class="account-wall">
                
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Depot/add_depot') ?>">

                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom" >
                            <?php echo form_error('nom'); ?>
                        </div>

                        <div class="col-md-3 form-group">
                           <button class="btn btn-sm btn-primary btn-block"  type="submit">  Ajouter</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                <hr>
                
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Depots</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($depot): foreach($depot as $row):  ?>
                        <tr>
                            <td> <?= $row->id_depot ?></td>
                            <td> <?= $row->depot ?></td>
                            <td> <?= $row->create_depot ?></td>
                            <td>
                                <a href="<?= base_url('Stocks/detail_depot').'/'.$row->id_depot ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
                            </td>
                        </tr>
                        
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
                <span class="clearfix"></span>
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>