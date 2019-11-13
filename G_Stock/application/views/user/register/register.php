<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <section class="page-banner" style="background-image:url('http://ctf.zeepap.com/assets/images/background/page-banner.jpg');">
    	<div class="auto-container">
        	<h1>Inscrivez-Vous !!</h1>
        </div>
    </section>
    <section class="price-plans style-two">
    	<div class="auto-container">
    	    <header class="cd-main-header">
				<h1> Inscription</h1>
				<p> </p>
		    </header>
		    
		    <div class="counter-section">
                <div class="row clearfix">
                    
            		<?php if (validation_errors()) : ?>
            			<div class="col-md-12">
            				<div class="alert alert-danger" role="alert">
            					<?= validation_errors() ?>
            				</div>
            			</div>
            		<?php endif; ?>
            		<?php if (isset($error)) : ?>
            			<div class="col-md-12">
            				<div class="alert alert-danger" role="alert">
            					<?= $error ?>
            				</div>
            			</div>
            		<?php endif; ?>
            		<div class="col-md-12">
            			<?= form_open() ?>
            				<div class="col-md-4 col-sm-6 form-group">
            					<label for="username">Nom d'utilisateur</label>
            					<input type="text" class="form-control" id="username" name="username" placeholder="Enter Nom d'utilisateur">
            					<p class="help-block">Au moins 4 caractères, lettres ou chiffres seulement</p>
            				</div>
            				<div class="col-md-4 col-sm-6 form-group">
            					<label for="email">Email</label>
            					<input type="email" class="form-control" id="email" name="email" placeholder="Entre email">
            					<p class="help-block">Une adresse email valide</p>
            				</div>
            				<div class="col-md-4 col-sm-6 form-group">
            					<label for="password">Mot de passe</label>
            					<input type="password" class="form-control" id="password" name="password" placeholder="Entre Mot de passe">
            					<p class="help-block">Au moins 6 caractères</p>
            				</div>
            				<div class="col-md-4 col-sm-6 form-group">
            					<label for="password_confirm">Confirmez le mot de passe</label>
            					<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirmez le mot de passe">
            					<p class="help-block">Doit correspondre à votre mot de passe</p>
            				</div>
            				<div class="col-md-12 form-group">
            					<input type="submit" class="btn btn-default" value="Inscrivez-Vous">
            				</div>
            			</form>
            		</div>
                </div>
            </div>
            
        </div>
    </section>
