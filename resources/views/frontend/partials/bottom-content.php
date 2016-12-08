</div>
</main>
<footer id="footer">
    <div class="footer-holder">
        <div class="container">
            <strong class="heading">Contact <span>Us</span></strong>
            <?= Form::open(array('url'=>'feedback','method'=>'POST','class'=>'submit-query'))?>
            <input type="hidden" name="type" value="contactUs">
            <div class="input-holder"><input type="text" placeholder="Name" name="name" ></div>
            <div class="input-holder"><input type="email" placeholder="Email" name="email" required></div>
            <div class="input-holder"><input type="text" placeholder="Phone" value="" name="phone"></div>
            <div class="input-holder"><input type="text" placeholder="Subject" name="subject" required></div>
            <textarea placeholder="Your message" name="message" required></textarea>
            <button type="submit">Send email <span class="icon-arrow-right"></span></button>
            <?= Form::close()?>
        </div>
        <div class="bottom-footer">
            <span class="rights">&copy;2016 <a href="<?= URL::to('/')?>">Nugree.com</a> All Rights Reserved.</span>
            <ul class="social-icons">
                <li><a href="https://www.facebook.com/Nugreecom-354399088098995/"><span class="icon-facebook"></span></a></li>
                <li><a href="https://plus.google.com/118057576547955586597?hl=en"><span class="icon-google-plus-symbol"></span></a></li>
                <li><a href="https://www.linkedin.com/in/nugree-pakistan-29a8a312a?trk=nav_responsive_tab_profile_pic"><span class="icon-linkedin"></span></a></li>
                <li><a href="https://twitter.com/92nugree"><span class="icon-twitter"></span></a></li>
                <li><a href="https://www.instagram.com/Nugree_Pakistan/"><span class="icon-instagram"></span></a></li>
            </ul>
        </div>
    </div>
</footer>

</div>
<nav id="nav">
    <a class="navigation-toggler close"><span class="icon-cross"></span></a>
    <form class="searchByID hidden">
        <input type="search" placeholder="Search by ID">
        <button type="submit"><span class="icon-search"></span></button>
    </form>
    <ul class="main-navigation text-upparcase">
        <li class="hidden">
            <a href="<?= URL::to('wanted-properties') ?>">Wanted Property</a>
        </li>
        <li>
            <a href="<?= URL::to('/')?>">HOME</a>
        </li>
        <li>
            <a href="<?= URL::to('/')?>/search">Properties</a>
        </li>
        <li>
            <a href="<?= URL::to('agents')?>">AGENTS</a>
        </li>
        <li>
            <a href="<?= (Route::getCurrentRoute()->getPath() !='/')? url('/').'#about-us':'#about-us'?>" class="<?= (Route::getCurrentRoute()->getPath() !='/')? '':'back-to-top'?>">ABOUT</a>
        </li>
        <li>
            <a href="<?= (Route::getCurrentRoute()->getPath() !='/')? url('/').'#footer':'#footer'?>" class="<?= (Route::getCurrentRoute()->getPath() !='/')? '':'back-to-top'?>">CONTACT</a>
        </li>
    </ul>
    <div class="mobile-content text-center">
        <ul class="social-icons">
            <li><a href="https://www.facebook.com/Nugreecom-354399088098995/"><span class="icon-facebook"></span></a></li>
            <li><a href="https://plus.google.com/118057576547955586597?hl=en"><span class="icon-google-plus-symbol"></span></a></li>
            <li><a href="https://www.linkedin.com/in/nugree-pakistan-29a8a312a?trk=nav_responsive_tab_profile_pic"><span class="icon-linkedin"></span></a></li>
            <li><a href="https://twitter.com/92nugree"><span class="icon-twitter"></span></a></li>
            <li><a href="https://www.instagram.com/Nugree_Pakistan/"><span class="icon-instagram"></span></a></li>
        </ul>
        <span class="copyright">Copyright, <a href="<?= URL::to('/')?>">Nugree.com</a></span>
    </div>
</nav>
<div class="nav-blur-area">
    <div class="logo-holder"><img src="<?= url('/')?>/web-apps/frontend/assets/images/logo.png" alt="Nugree"></div>
    <ul class="bottom-links">
        <li></li>

        <li><a class="mail" href="mailto:&#105;&#110;&#102;&#111;&#064;&#110;&#117;&#103;&#114;&#101;&#101;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#110;&#117;&#103;&#114;&#101;&#101;&#046;&#099;&#111;&#109;</a></li>
    </ul>
</div>

<div class="popup-holder">
    <div id="submit-requirement-popup" class="lightbox generic-lightbox">
        <span class="lighbox-heading">Submit you <span>requirement</span></span>
        <form class="inquiry-email-form">
            <div class="field-holder">
                <label for="requirement-name">Name</label>
                <div class="input-holder"><input type="text" id="requirement-name"></div>
            </div>
            <div class="field-holder">
                <label for="requirement-email">Email</label>
                <div class="input-holder"><input type="email" id="requirement-email"></div>
            </div>
            <div class="field-holder">
                <label for="requirement-phone">Mobile</label>
                <div class="input-holder"><input type="tel" id="requirement-phone"></div>
            </div>
            <div class="field-holder">
                <label for="requirement-subject">Purpose</label>
                <div class="input-holder"><input type="text" id="requirement-subject"></div>
            </div>
            <div class="field-holder">
                <label for="requirement-message">Message</label>
                <div class="input-holder">
                    <textarea id="requirement-message"></textarea>
                    <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                </div>
            </div>
            <button type="submit">SEND</button>
        </form>
    </div>
    <div id="alerts-nugree" class="lightbox generic-lightbox alert-ligthbox-onload">
        <img src="<?= url('/') ?>./assets/imgs/popup.png" alt="image description">
        <a href="#" class="close"></a>
    </div>
    <div id="found-match" class="lightbox generic-lightbox">
        <span class="lighbox-heading">Notify me</span>
            <form class="inquiry-email-form">
                <input type="hidden" name="searched_params" id="searched-url-params" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <div class="field-holder">
                    <label for="email">Email</label>
                    <div class="input-holder"><input type="email" name="email" required id="notify-email"></div>
                </div>
                <div class="field-holder">
                    <label for="phone">phone</label>
                    <div class="input-holder"><input type="tel" name="mobile" required id="notify-mobile"></div>
                </div>
                <button type="submit" class="notify-ajax-request">SEND</button>
            </form>
            <a href="#" class="close"></a>
    </div>
</div>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/smooth-scroll.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/star-rating.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/jquery.carousel.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/jquery.slideshow.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/placeholder.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/fixed-block.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/lightBox.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/jquery-main.js" type="text/javascript" defer></script>
<script src="<?= url('/')?>/web-apps/frontend/assets/js/registration.js" type="text/javascript" defer></script>
<!--<script src="--><?//= url('/')?><!--/web-apps/frontend/assets/js/property_detail.js" type="text/javascript"></script>-->
<script src="<?= url('/')?>/assets/js/helper.js" type="text/javascript"></script>
<script src="<?= url('/')?>/assets/js/ajax-locations-search.js" type="text/javascript"></script>
<script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",53331]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
</body>
<div id="fb-root"></div>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-86881543-1', 'auto');
    ga('send', 'pageview');
</script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</html>