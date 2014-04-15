<?php if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>'); ?>
<style>
.contact-form .form-block input[type="text"],textarea{
    width: 430px !important;
    margin: 3px 0 10px 0;
    padding: 0 5px;
}
input[type="submit"]{
    float: right;
    margin-right: 35px;
}
.form-block {
    margin-bottom: 10px !important;
}

textarea{
    height: 80px;
    padding: 5px;
}

input.form-update.orange_button{
    background: #f08643 !important;
}
.recaptcha_theme_red #recaptcha_response_field{
    padding: 0 4px !important;
    height: 30px;
    width: 147px !important;
}

.row{
    overflow: hidden;
}

#recaptcha_area{
    height: 80px !important;
}

.contact-info{
    padding: 5px;
}

.contact-info p{
    padding: 8px 0;
    border-bottom: 1px dotted #aaa;
}

.google_map{
    border:4px solid #ddd;
    overflow: hidden;
    width: 100%;
}

</style>

<?php

if($_POST)
{
    input::set(array(
        'name'=>'s',
        'email'=>'email',
        'subject'=>'s',
        'message'=>''
    ));

    extract($post = input::pushInArray(array('name','email','subject','message')));

    if(!helper::isValidToken())
    {
        error::notice('error','Easy mann!');
    }
    else if(helper::isEmpty($post))
    {
        error::notice('warning','Please fill all required fields');
    }

    else if(!helper::isEmail($email))
    {
        error::notice('warning','Please enter a valide email.');
    }

    if(!helper::reCaptcha())
    {
        error::notice('error','Invalid security key');
    }

    else if(helper::sendEmail(settings::get()->siteEmail,$subject,$message,$email))
    {
        //redirect::re('page/read/contact-us',1);
        //error::notice('success','Your message has been sent');
        error::flash('success','Your message has been sent','page/read/contact-us');

    }

    else{
        error::notice('error',"Fail!");
    }

}




?>
<div class="row">


<div class="fr contact-form" style="width: 450px">
        <?php echo html::formOpen('page/read/contact-us')?>

        <div class="form-block" >
            <p style="padding: 10px 0; text-align: center">We hope you will give us a call with any questions or comments but feel free to use the contact form below if you prefer.</p>
        </div>

        <div class="form-block">
            <div>Name</div>
            <input type="text" class="form-block" name="name" value="<?php echo input::get('name','s'); ?>">
        </div>

        <div class="form-block">
            <div>E-mail</div>
            <input type="text" class="form-block" name="email"  value="<?php echo input::get('email','email'); ?>">
        </div>

        <div class="form-block">
            <div>Subject</div>
            <input type="text" class="form-block" name="subject" value="<?php echo input::get('subject','s'); ?>">
        </div>

        <div class="form-block">
            <div>Message</div>
            <textarea name="message"><?php echo input::get('message',''); ?></textarea>
        </div>

        <?php echo recaptcha_get_html(config::get('RECAPTCHA_PUBLIC_KEY'), error::$err); ?>
        <input class="orange_button form-update" type="submit" value="Send">

    <?php echo html::formClose(); ?>

    </div>


    <div class="lf contact-info" style="width: 400px">
        <p><strong>Address</strong> : Oscar Car Rentals P.O.Box: 195 Girne Mersin 10 Turkey</p>
        <p><strong>Phone</strong> : (+90) 392 815 2272 - (+90) 392 815 5670</p>
        <p><strong>Fax</strong> : (+90) 392 815 3858</p>
        <p><strong>Mobile</strong> : (+90) 542 883 07 05  &nbsp; &middot; &nbsp;
                                        (+90) 533 864 38 06  &nbsp; &middot; &nbsp;
                                        (+90) 542 851 0702</p>
        <p><strong>E-Mail </strong>: <a href="mailto:oscarrentacar@oscargroup.co">oscarrentacar@oscargroup.co</a>  -
                <a href="Ulupinar@oscargroup.co">Ulupinar@oscargroup.co</a></p>


        <div class="google_map" style="margin-top: 35px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3254.8392944004922!2d33.329054!3d35.334812!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2s!4v1396447419406" width="400" height="300" frameborder="0" style="border:0"></iframe>
        </div>
    </div>



<div style="clear:both"></div>
</div>
