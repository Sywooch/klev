<div class="lc-index-right__head">
    <div class="lc-index-right__head_user">
        <div class="lc-index-right__head_user_img" style="background-image: url('<?=Yii::$app->user->identity->photo ? '/images/users/'.Yii::$app->user->identity->photo.'' : '/images/site_images/no_object.png'?>')">
        </div>
        <div class="lc-index-right__head_user_info1">
            <div class="lc-index-right__head_user_info1_name">
                <?=Yii::$app->user->identity->first_name?> <?=Yii::$app->user->identity->surname?>
            </div>
            <div class="lc-index-right__head_user_info1_id">
                ID: <?=Yii::$app->user->id?>
            </div>
            <div class="lc-index-right__head_user_info1_settings">
                <a href="/lc/profile">Настройки профиля</a>
            </div>
        </div>
    </div>
    <?php if ($bronPastDontAccepted = Yii::$app->user->identity->bronPastDontAccepted) : ?>
        <div class="lc-index-right__head_z">
            <div class="lc-index-right__head_z_new">
                У вас <span><?=count($bronPastDontAccepted)?> новых заявок</span>
            </div>
            <div class="lc-index-right__head_z_change">
                <a href="/lc/reserve">Управление заявками</a>
            </div>
            <!--<div class="lc-index-right__head_z_balance">
                Ваш баланс: 50 520Р
            </div>-->
        </div>
    <?php endif;?>

    <div class="lc-index-right__head_welcome">
        <div class="lc-index-right__head_welcome_text">
            Добро пожаловать в панель управления
        </div>
    </div>
</div>