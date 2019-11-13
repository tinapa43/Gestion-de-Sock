<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">

            
            <div class="panel panel-info col-sm-12 col-md-12">
                <h1 class="panel-heading text-center login-title">Information Société </h1>
                
                <?php if(isset($msg)) { echo $msg; }; ?> 
                <div class="account-wall">
                    <form class="form-signin" method="POST" action="<?= base_url('index.php/Config/add_info') ?>">

                        <div class="col-md-3 form-group">
                            <label>Société</label>
                            <input type="text" class="form-control" value="<?= $row->ste_info ?>" name="ste" placeholder="ste" >
                            <?php echo form_error('ste'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Adress</label>
                            <input type="text" class="form-control" value="<?= $row->adress_info ?>" name="adress" placeholder="adress" >
                            <?php echo form_error('adress'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Tel</label>
                            <input type="text" class="form-control" value="<?= $row->tel_info ?>" name="tel" placeholder="Tél" >
                            <?php echo form_error('tel'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Fax</label>
                            <input type="text" class="form-control" value="<?= $row->fax_info ?>" name="fax" placeholder="fax" >
                            <?php echo form_error('fax'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo" >
                            <?php echo form_error('logo'); ?>
                        </div>
                        
                        <div class="col-md-3 form-group">
                            <label> Autre Information </label>
                            <input type="text" class="form-control" value="<?= $row->i_1_info ?>" name="1_info" placeholder="Autre Information" >
                            <?php echo form_error('1_info'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label> Autre Information </label>
                            <input type="text" class="form-control" value="<?= $row->i_2_info ?>" name="2_info" placeholder="Autre Information" >
                            <?php echo form_error('2_info'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label> Autre Information </label>
                            <input type="text" class="form-control" value="<?= $row->i_3_info ?>" name="3_info" placeholder="Autre Information" >
                            <?php echo form_error('3_info'); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label> Autre Information </label>
                            <input type="text" class="form-control" value="<?= $row->i_4_info ?>" name="4_info" placeholder="Autre Information" >
                            <?php echo form_error('4_info'); ?>
                        </div>

                        <div class="col-md-3 form-group">
                            <label> </label>
                           <button class="btn btn-md btn-success btn-block"  type="submit">  Modifier</button>
                        </div>

                        <span class="clearfix"></span>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>