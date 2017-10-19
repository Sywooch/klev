<div class="header3">
    <div class="header3-block1">
        <div class="container">
            <div class="header3__logo">
                <a href="/">
                    <div class="counter1__logo">
                        <div class="counter1__logo_img">
                            <div class="counter1__logo_img_left">
                                <img src="/images/site_images/logo-left1.png" alt="">
                            </div>
                            <div class="counter1__logo_img_center">
                                <img src="/images/site_images/logo-center2.png" alt="">
                            </div>
                            <div class="counter1__logo_img_right">
                                <img src="/images/site_images/logo-right1.png" alt="">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="header3__logo_buttons">
                <div class="header3__logo_buttons_lc">
                    <a href="/lc" >Объектам</a>
                </div>
                <div class="header3__logo_buttons_reg">
                    <a href="/investoram">Инвесторам</a>
                </div>
                <div class="header3__logo_buttons_login">
                    <a href="/presse">Прессе</a>
                </div>
            </div>
        </div>
    </div>

    <div class="header3-block2">
        <div class="header3-block2_title">
            <?=$this->title?>
        </div>
        <div class="header3-block2_border">
        </div>
        <div class="header3-block2_bread">
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
    </div>
</div>
