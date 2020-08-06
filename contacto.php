<?php include('plantillas/bootstrap.php'); ?> 

<?php include('plantillas/header.php'); ?>

<div class="container">
    <div class="row mt-2">

        <div class="col-sm-12 col-md-4 col-lg-4" style="max-width: 100%;">
            <div class="mb-2">
                <img src="img/correo.png" alt="">
                <label> cremeriayabarrotesliz@gmail.com</label>
            </div>

            <div class="mb-2">
                <img src="img/red_social.png" alt="">
                <label> 
                <a href="https://www.facebook.com/Cremeria-Liz-215060466586799/?view_public_for=215060466586799">
                Cremeria Liz</a> 
                </label>
            </div>

            <div class="mb-2">
                <img src="img/whats.png" alt="">
                <label> 33-12-45-78-96 </label>
            </div>

            <div class="mb-2">
                <img src="img/ubicacion.png" alt="">
                <label>Maria C. Bacalari #3027 Echeverria.</label>
            </div>

        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 mb-2" align="center">
            <div class="m-auto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3734.0977620534063!2d-103.36407218559918!3d20.624871606820356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ad86dec01a3b%3A0x36f000abe4e24dc2!2sCremeria%20y%20Abarrotes%20%22Liz%22!5e0!3m2!1ses!2smx!4v1596668749918!5m2!1ses!2smx"  height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>   
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 m-auto">
            <div style="border-top: .3rem solid rgb(224, 191, 3); max-width: 100%;" class="bg-light pt-0 p-4 ">
                <h5 class="text-center mb-4  font-weight-light">Comentarios o Sugerencias</h5>
                <form>
                    <div class="form-group">
                      <label for="correoComent">Correo electrónico</label>
                      <input type="email" class="form-control" id="correoComent">
                    </div>
                    <div class="form-group">
                      <label for="areaComent">Escribe tu comentario o sugerencia</label>
                      <textarea class="form-control" id="areaComent" rows="4"></textarea>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<?php include('plantillas/chatFace.php'); ?>
<?php include('plantillas/footerAdaptado.php'); ?> 