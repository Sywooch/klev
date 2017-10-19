<div class="header2">
    <div class="container">
        <div class="header2__inner">
            <div class="header2__inner_block1">
                <div class="header2__inner_block1_logo">
                    <a href="/">
                        <img src="/images/site_images/catalog/logo1.png" alt="">
                        <span class="header2__inner_block1_logo_text">
                            сервис клёвых места
                        </span>
                    </a>
                </div>
            </div>
            <div class="header2__inner_block2">
                <div class="header2__inner_block2_object">
                    <a href="/lc/add">Зарегистрировать свой объект</a>
                </div>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <!--<div class="header2__inner_block2_reg">
                        <a href="/signup">Зарегистрироваться</a>
                    </div>-->
                    <div class="header2__inner_block2_lc">
                        <a href="/login">Войти в аккаунт</a>
                    </div>
                <?php else:?>
                    <div class="header2__inner_block2_lc">
                        <a href="/logout">Выйти из аккаунта</a>
                    </div>
                <?php endif;?>

            </div>
        </div>
    </div>
</div>