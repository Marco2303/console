<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\Session;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>  
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" >
    <?php
        $s = new Session();
        $level = $s->get('level');
    
    NavBar::begin([
//        'brandLabel' => '<h2> Ordini Punti Vendita </h2',
        'brandLabel' => Html::img('images/scatolecarta.jpg'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'my-navbar',
        ],
    ]);
    $pippo = Yii::$app->user->isGuest;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav mynavbar navbar-right navWidget'],
        'items' => [
            //menu admin
//            ['label' => 'Cerca', 'items' => [
//                ['label' => 'Lista completa', 'url' => ['constestata/index'], 'visible' => $level == 'ADMIN'],                
//                ['label' => 'Configura utenti', 'url' => ['/tabusers/index'], 'visible' => $level == 'ADMIN'], 
//                ['label' => 'Cofigura FTP', 'url' => ['/tabftp/index'], 'visible' => $level == 'ADMIN'], 
//                ['label' => 'LOG', 'url' => ['/tabvolantini/log'], 'visible' => $level == 'ADMIN'], 
//            ], 'visible' => $level == 'ADMIN'],            
            ['label' => 'Lista tutti', 'url' => ['constestata/index'], 'visible' => $level == 'ADMIN'],
            ['label' => 'Configura', 'url' => ['consappconfig/index'], 'visible' => $level == 'ADMIN'],
            // menu utente
//            ['label' => 'Home', 'url' => ['/tabvolantini/index'], 'visible' => $level == 'UTENTE'],
//            ['label' => 'Manage', 'items' => [
//                ['label' => 'Da comunicare', 'url' => ['/tabvolantini/local'], 'visible' => $level == 'UTENTE'],
//                ['label' => 'On line', 'url' => ['/tabpdv/index'], 'visible' => $level == 'UTENTE'],
//            ], 'visible' => $level == 'UTENTE'],    
//            ['label' => 'Utility', 'items' => [
//                ['label' => 'Configura PDV', 'url' => ['/tabpdv/index'], 'visible' => $level == 'UTENTE'],
////              ['label' => 'Gestione volantini', 'url' => ['/tabvolantini/gestionevolantini'], 'visible' => $level == 'UTENTE'],
//                ['label' => 'Transazioni', 'url' => ['/tabvolantini/log'], 'visible' => $level == 'UTENTE'],
////              ['label' => 'About', 'url' => ['/site/about'], 'visible' => $level == NULL],
////              ['label' => 'Contact', 'url' => ['/site/contact'], 'visible' => $level == NULL],
//            ], 'visible' => $level == 'UTENTE'],   
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout-color']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" id="bottomcolor">
    <div class="container">
        <p class="pull-left">&copy; G.M.F. Spa <?= date('Y') ?></p>

        <p class="pull-right">Oggi:<?=  date('d').'/'.date('m').'/'.date('Y')  ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
